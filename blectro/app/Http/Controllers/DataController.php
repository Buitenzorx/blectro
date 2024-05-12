<?php

namespace App\Http\Controllers;
use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
    return Data::all();
    }
    public function store(Request $request)
    {
        $data = new Data;
        $data->device_id = $request->device_id;
        $data->data = $request->data;
        $data->save();
        
        return response()->json([
        "message" => "Device telah ditambahkan."
        ], 201);
    }
    public function show(string $id)
    {
    return Data::where('device_id', $id)->orderby('created_at', 'DESC')->get();
    }

    public function web_show(string $id){
        return view('device',[
            "title" =>"device",
            "device" => data::find($id),
            "data" => Data::where('device_id', $id)->orderby('created_at', 'DESC')->get()
        ]);
    }
}
    
