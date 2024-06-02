<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\Device;
use App\Models\Datalog;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return Data::all();
    }

    public function store(Request $request)
    {
        // Create new Data entry
        $data = new Data;
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();
        
        // Check if Device exists and update its 'nilai' field
        if (Device::where('id', $request->device_id)->exists()) {
            $device = Device::find($request->device_id);
            $device->nilai = $request->data;
            $device->save();
        }
        
        // Log the data
        $datalog = new Datalog;
        $datalog->device_id = $request->device_id;
        $datalog->device_name = $request->device_name; // Assuming device_name is passed in the request
        $datalog->devicetype = $request->devicetype; // Assuming devicetype is passed in the request
        $datalog->useraction = $request->useraction; // Assuming useraction is passed in the request
        $datalog->valuelog = $request->data;
        $datalog->statuslog = $request->statuslog; // Assuming statuslog is passed in the request
        $datalog->save();

        // Check if the sensor is MQ-2 (device_id 2) and affect the buzzer (device_id 5)
        if ($request->device_id == 2) { // Assuming MQ-2 has device_id 2
            $buzzer = Device::find(5); // Assuming buzzer has device_id 5
            if ($buzzer) {
                if ($request->data >= 300) {
                    $buzzer->nilai = 1; // Set buzzer to 1 if MQ-2 value is >= 300 ppm
                } else {
                    $buzzer->nilai = 0; // Set buzzer to 0 otherwise
                }
                $buzzer->save();
            }
        }

        return response()->json([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function show(string $id)
    {
        return Data::where('device_id', $id)->orderby('created_at', 'DESC')->get();
    }

    public function web_show(string $id)
    {
        return view('device', [
            "title" => "device",
            "device" => Device::find($id),
            "data" => Data::where('device_id', $id)->orderby('created_at', 'DESC')->get()
        ]);
    }
}