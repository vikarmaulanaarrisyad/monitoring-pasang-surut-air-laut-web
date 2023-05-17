<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use Illuminate\Http\Request;

class SensorLaravelController extends Controller
{
    public function getDataSensor()
    {
        $sensor = Sensor::all();

        return response()->json(['data' => $sensor]);
    }

    public function getSingleDataSensor()
    {
        $sensor = Sensor::latest()->orderBy('created_at','DESC')->first();
        return response()->json(['data' => $sensor]);

    }

    public function store(Request $request)
    {
        $data = [
            'tanggal' => Date('Y-m-d'),
            'sensor' => $request->sensor,
            'status' => $request->status,
        ];

        Sensor::create($data);
    }
}
