<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use DateTime;
use DateTimeZone;
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
        $sensor = Sensor::latest()->orderBy('created_at', 'DESC')->first();
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

    public function getSensorAjax(Request $request)
    {
        $listDataSensor = [];
        $listTanggal = [];
        $listStatus = [];
        $dataSensor = Sensor::orderBy('created_at', 'ASC')->get();

        foreach ($dataSensor as $sensor) {
            $listDataSensor[] = $sensor->sensor;
            $listTanggal[] = $sensor->created_at->format('Y-m-d H:i:s'); // Ubah format tanggal menjadi YYYY-MM-DD HH:mm:ss
            $listStatus[] = $sensor->status;
        }

        // Konversi waktu ke zona waktu yang diinginkan (jika perlu)
        // Misalnya, jika ingin mengubah zona waktu ke GMT+7
        foreach ($listTanggal as $key => $tanggal) {
            $datetime = new DateTime($tanggal, new DateTimeZone('UTC'));
            $datetime->setTimezone(new DateTimeZone('Asia/Jakarta'));
            $listTanggal[$key] = $datetime->format('Y-m-d H:i:s');
        }

        return response()->json([
            'listTanggal' => $listTanggal,
            'listDataSensor' => $listDataSensor,
            'listStatus' => $listStatus
        ]);
    }
}
