<?php

namespace App\Http\Controllers;
use App\Models\Data;
use App\Models\Device;
use App\Models\Datalog;
use Illuminate\Http\Request;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\DataController;

class DatalogController extends Controller
{
    public function index()
    {
        return Datalog::all(); // Retrieve all log data from the database
    }

    public function store(Request $request)
    {
        // Store the log data
        $datalog = new Datalog;
        $datalog->device_id = $request->device_id;
        $datalog->device_name = $request->device_name;
        $datalog->devicetype = $request->devicetype;
        $datalog->useraction = $request->useraction;
        $datalog->valuelog = $request->valuelog;
        $datalog->statuslog = $request->statuslog;
        $datalog->save();

        return response()->json([
            "message" => "Data telah ditambahkan."
        ], 201);
    }

    public function show(string $id)
    {
        return Device::find($id);
    }

    public function showData()
    {
        return Data::all();
    }

    public function web_show()
    {
        $datalog = Datalog::all(); // Retrieve all log data from the database
        return view('datalogs', compact('datalog'));
    }

    // New method to get device and data details
    public function update(Request $request, string $id)
        {
        if (Datalog::where('id', $id)->exists()) {
            $device = Datalog::find($id);
            $device->device_id = is_null($request ->device_id) ? $datalog->device_id : $request->device_id;
            $device->device_name = is_null($request ->device_name) ? $datalog->device_name : $request->device_name;
            $device->devicetype = is_null($request->devicetype) ? $datalog->devicetype : $request->devicetype;
            $device->useraction = is_null($request->useraction) ? $datalog->useraction : $request->useraction;
            $device->valuelog = is_null($request->valuelog) ? $datalog->valuelog : $request->valuelog;
            $device->statuslog = is_null($request->statuslog) ? $datalog->statuslog : $request->statuslog;
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
}
