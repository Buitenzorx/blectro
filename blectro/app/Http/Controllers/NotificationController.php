<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return Notification::all();
    }
    public function store(Request $request)
    {
        $token = "UD#yNu+x__gYSD2dtAqr"; // Token tetap
        $target = $request->input('target'); // Mengambil target dari permintaan HTTP
        $message = $request->input('message'); // Mengambil pesan dari permintaan HTTP
        Notification::create([
            'user_phone_number' => $target,
            'message' => $message
        ]);
        // Kirim notifikasi
        $response = $this->sendNotification($token, $target, $message);

        // Simpan data ke database Notification
        

        $notificationLog = new Notification;
        $notificationLog->user_phone_number = $target;
        $notificationLog->message = $message;
        $notificationLog->save();

        // Kembalikan respons JSON
        return response()->json([
            "message" => "Notifikasi Telah Dikirimkan dan Data Telah Disimpan ke Database."
        ], 201);
    }

    private function sendNotification($token, $target, $message)
    {
        $postData = json_encode(array(
            'target' => $target,
            'message' => $message
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

    public function web_show()
    {
        $notificationLog = Notification::latest()->get();
        return view('notification', compact('notificationLog'));
    }
}
