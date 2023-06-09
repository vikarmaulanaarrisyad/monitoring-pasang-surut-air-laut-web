<?php

namespace App\Http\Controllers\Api;

use DateTime;
use DateTimeZone;
use App\Models\Sensor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Validator;

class SensorLaravelController extends Controller
{

    public function getAllData(Request $request)
    {
        $result = Sensor::orderBy('id','DESC')->first();

        return $result;
    }


    public function getDataSensor(Request $request)
    {
        // $date_range = $request->input('datefilter');
        // if (strpos($date_range, ' - ') !== false) {

        //     $date_parts = explode(' - ', $date_range);

        //     $start_date  = $date_parts[0];
        //     $end_date  = $date_parts[1];

        //     $sensor = Sensor::when($request->datefilter != "", function ($query) use ($start_date, $end_date) {
        //         $query->whereBetween('tanggal', [$start_date, $end_date]);
        //     })->orderBy('id', 'DESC');
        // } else {
        //     $sensor = Sensor::when($request->has('status') != "" && $request->status != "", function ($query) use ($request) {
        //         $query->where('status', $request->status);
        //     })->orderBy('id', 'DESC');
        // }

        $sensor = Sensor::when($request->has('status') != "" && $request->status != "", function ($query) use ($request) {
            $query->where('status', $request->status);
        })->orderBy('id','DESC');

        // return response()->json(['data' => $sensor]);
        return datatables($sensor)
            ->addIndexColumn()
            ->editColumn('tanggal', function ($sensor) {
                return tanggal_indonesia($sensor->created_at);
            })
            ->editColumn('waktu', function ($sensor) {
                return date('H:i:s', strtotime($sensor->created_at)) . ' WIB';
            })
            ->editColumn('sensor', function ($sensor) {
                return $sensor->sensor . ' cm';
            })
            ->editColumn('weend_speed', function ($sensor) {
                return $sensor->weend_speed . ' m/s';
            })
            ->editColumn('suhu', function ($sensor) {
                return $sensor->suhu . ' °C';
            })
            ->editColumn('humidity', function ($sensor) {
                return $sensor->kelembaban . ' %';
            })
            ->editColumn('status', function ($sensor) {
                return '
                    <span class="badge badge-' . $sensor->statusColor() . '"> ' . $sensor->status . '</span>
                ';
            })
            ->escapeColumns([])
            ->make(true);
    }

    public function getLatestData()
    {
        $data = Sensor::orderBy('created_at', 'asc')->limit(10)->take(5)->get();

        return response()->json(['data' => $data]);
    }

    public function getSingleDataSensor()
    {
        $sensor = Sensor::latest()->orderBy('created_at', 'DESC')->first();
        return response()->json(['data' => $sensor]);
    }

    public function data_multiple()
    {
        $sensor = Sensor::all();

        return response()->json(['data' => $sensor]);
    }

    public function store(Request $request)
    {
        $data = [
            'tanggal' => Date('Y-m-d'),
            'sensor' => $request->sensor,
            'status' => $request->status,
            'weend_speed'   => $request->weend_speed,
            'suhu'   => $request->suhu,
            'kelembaban'   => $request->kelembaban,
        ];

        Sensor::create($data);
    }

    public function getSensorAjax(Request $request)
    {
        $latestSensor = Sensor::latest()->first();

        return response()->json([
            'data' => $latestSensor,
        ]);
    }
    public function getKecepatanAll(Request $request)
    {
        $kecepatan = Sensor::orderBy('id', 'ASC')->latest()->limit(5)->get();

        return response()->json([
            'data' => $kecepatan,
        ]);
    }

    public function kirimDataSensor(Request $request)
    {

        $post = Sensor::create([
            'tanggal' => date('Y-m-d'),
            'sensor'     => $request->input('distance'),
            'weend_speed'   => $request->input('weend_speed'),
            'status'   => $request->input('status'),
            'suhu'   => $request->input('suhu'),
            'kelembaban'   => $request->input('kelembaban'),
        ]);

        if ($post) {
            return response()->json([
                'success' => true,
                'message' => 'Berhasil Disimpan!',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Disimpan!',
            ], 401);
        }
    }

    public function getDataSuhu()
    {
        $suhu = Sensor::offset(2)->take(5)->get();

        return response()->json(['data' => $suhu]);
    }

    public function getDataHumidity()
    {
        $suhu = Sensor::all();

        dd($suhu);
        // $suhu = Sensor::offset(2)->take(5)->get();

        return response()->json(['data' => $suhu]);
    }
}
