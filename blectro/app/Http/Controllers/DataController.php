<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\Device;
use App\Models\Datalog;
use Illuminate\Support\Facades\Http;
use App\Models\Notification;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        return Data::all();
        $data = Data::where('device_id', $id)->orderBy('created_at', 'DESC')->get();

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
        if ($request->device_id == 2 || $request->device_id == 1) { // Assuming MQ-2 has device_id 2
            $buzzer = Device::find(5); // Assuming buzzer has device_id 5
            if ($buzzer) {
                if ($request->data >= 300 && $request->device_id == 2 ) {
                    $buzzer->nilai = 1; // Set buzzer to 1 if MQ-2 value is >= 300 ppm
                } else if ($request->data >= 30  && $request->device_id == 1 ) {
                    $buzzer->nilai = 1; // Set buzze) {
                } else {
                    $buzzer->nilai = 0; // Set buzzer to 0 otherwise
                }
                $buzzer->save();
            }
        }
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
    
    
        $datalog = new Datalog;
        $datalog->device_id = $request->device_id;
        $datalog->device_name = $request->device_name; 
        $datalog->devicetype = $request->devicetype; 
        $datalog->useraction = $request->useraction;
        $datalog->valuelog = $request->data;
        $datalog->statuslog = $request->statuslog; 
        $datalog->save();

        if ($request->device_id == 2 && $request->data >= 300) {
            $message = "MQ-2 : Gas Mencapai 300 ppm!!!!!! " . $request->data;
            $response = $this->sendNotification($message);
        }  else if ($request->device_id == 1 && $request->data >= 30){
            $message = "DHT11: Temperature Mencapai 30 derajat!!!!!! " . $request->data;
            $response = $this->sendNotification($message);
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

    public function updateData(Request $request, $id)
    {
        // Validasi permintaan
        $request->validate([
            'status' => 'required|in:ON,OFF' // Sesuaikan dengan aturan validasi yang diperlukan
        ]);

        // Perbarui status perangkat dengan ID yang sesuai
        $device = Device::findOrFail($id);
        $device->status = $request->status;
        $device->save();

        // Berikan respons kembali ke klien
        return response()->json(['message' => 'Data Berhasil Di Perbarui']);
    }

    private function sendNotification($message)
    {
        $token = "UD#yNu+x__gYSD2dtAqr"; // Token tetap

        $postData = json_encode(array(
            'target' => '6289515563894', // Tentukan target notifikasi sesuai kebutuhan
            'message' => $message,
            'countryCode' => '62' //optional
        ));

        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.fonnte.com/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: $token"
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        return $response;
    }

    public function getRainSensorData()
    {
        $rainSensorData = Data::where('device_id', 3)->orderBy('created_at', 'DESC')->take(10)->get();
        $labels = $rainSensorData->pluck('created_at');
        $dataValues = $rainSensorData->pluck('data');

        return response()->json([
            'labels' => $labels,
            'dataValues' => $dataValues
        ]);
    }


}