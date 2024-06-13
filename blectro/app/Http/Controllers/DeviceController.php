<?php
namespace App\Http\Controllers;
use App\Models\Device;
use App\Models\Data;
use App\Models\Datalog;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
class DeviceController extends Controller
{
    public function index()
    {
    return Device::all();
    
    }
    public function store(Request $request)
    {
        $device = new Device;
        $device->nama_device = $request->nama_device;
        $device->nilai_min = $request->nilai_min;
        $device->nilai_max = $request->nilai_max;
        $device->nilai = $request->nilai;
        $device->save();
        
        return response()->json([
        "message" => "Device telah ditambahkan."
        ], 201);
    }
    public function show(string $id)
    {
    return Device::find($id);
    }
    public function update(Request $request, string $id)
        {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->nama_device = is_null($request ->nama_device) ? $device->nama_device : $request->nama_device;
            $device->nilai = is_null($request->nilai) ? $device->nilai : $request->nilai;
            $device->save();
            

            return response()->json([
            "message" => "Device telah diupdate."
            ], 201);
        } else {
            return response()->json([
            "message" => "Device tidak ditemukan."
            ], 404);
        }
        }
    public function destroy(string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->delete();
            return response()->json([
            "message" => "Device telah dihapus."
            ], 201);
        } else {
            return response()->json([
            "message" => "Device tidak ditemukan."
            ], 404);
        }
    }

    public function showDevices()
    {
        return view('devices', [
            "title" => "devices",
            "devices" => Device::all()
        ]);
    }
    public function showDashboard()
    {
        $devices = Device::all();
        
        return view('dashboard', [
            "title" => "dashboard",
            "devices" => $devices
        ]);
    }

    

        public function getDeviceId($id)
    {
        $device = Device::find($id); 
        if (!$device) {
            return "Perangkat dengan ID $id tidak ditemukan.";
        }
        return view('device', [
            "title" => "device",
            "devices" => [$device], 
            "nilai" => Device::find($id)
        ]);
    }   
    public function getLatestData()
    {
        $device = Device::find(1); // Mengambil data dari device dengan ID 1
        return response()->json($device);
    }

    public function webDashboard()
    {
        // Mengambil data dari device dengan id 3
        $device = Device::find(3);
            // Mengambil semua data dari device_id 3 beserta created_at
        $rainData = Data::where('device_id', 3)->orderBy('created_at')->get();

        // Mendapatkan data dan label untuk grafik
        $labels = $rainData->pluck('created_at')->map(function ($timestamp) {
            // Mengambil hanya tanggal dan jam dari timestamp dan mengatur zona waktu ke WIB
            return Carbon::parse($timestamp)->setTimezone('Asia/Jakarta')->format('H:i:s'); // Format 'Y-m-d H:i:s' untuk tanggal dan jam
        })->toArray();

        // Memeriksa apakah dataValues kosong
        $dataValues = $rainData->pluck('data')->toArray();
        return view('dashboard', [
            "title" => "dashboard",
            "rainData" => $rainData,
            "device_id" => $device->id,
            "nilai" => $device->nilai,
            "labels" => $labels,
            "dataValues" => $dataValues,
            "devices" => Device::all(),
            "notificationLog" =>Notification::all()
        ]);
         

    }
    public function toggleLED(Request $request)
    {
        // Log untuk debugging
        \Log::info('Request Data: ', $request->all());

        $device = Device::find($request->device_id);

        if ($device) {
            $device->nilai = $request->data; // Asumsikan 1 untuk ON dan 0 untuk OFF
            $device->save();
            
            $data->device_id = $request->device_id;
            $data->data = $request->data;
            $data->save();

            // Log untuk debugging
            \Log::info('Device updated: ', $device->toArray());

            // Catat log atau lakukan tindakan lain yang diperlukan
            Datalog::create([
                'device_id' => $request->device_id,
                'data' => $request->data,
                'device_name' => $request->device_name,
                'devicetype' => $request->devicetype,
                'useraction' => $request->useraction,
                'statuslog' => $request->statuslog,
            ]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}