<?php
namespace App\Http\Controllers;
use App\Models\Device;
use Illuminate\Http\Request;
class DeviceController extends Controller
{
        public function index()
        {
        return Device ::all();
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
    return Device ::find($id);
    }
        public function update(Request $request, string $id)
        {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->nama_device = is_null($request->nama_device) ? $device->nama_device : $request->nama_device;
            $device->nilai_min = is_null($request->nilai_min) ? $device->nilai_min : $request->nilai_min;
            $device->nilai_max = is_null($request->nilai_max) ? $device->nilai_max : $request->nilai_max;
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
}