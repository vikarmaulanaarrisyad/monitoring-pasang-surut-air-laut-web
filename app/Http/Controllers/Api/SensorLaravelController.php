<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Sensor;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class SensorLaravelController extends Controller
{
    public function getDataSensor(Request $request)
    {

        $date_range = $request->input('datefilter');
        if (strpos($date_range, ' - ') !== false) {

            $date_parts = explode(' - ', $date_range);

            $start_date  = $date_parts[0];
            $end_date  = $date_parts[1];

            $sensor = Sensor::when($request->datefilter != "", function ($query) use ($start_date, $end_date) {
                $query->whereBetween('created_at', [$start_date, $end_date]);
            });
        } else {
            $sensor = Sensor::orderBy('created_at', 'ASC');
        }

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
            ->editColumn('status', function ($sensor) {
                return '
                    <span class="badge badge-' . $sensor->statusColor() . '"> ' . $sensor->status . '</span>
                ';
            })
            ->escapeColumns([])
            ->make(true);
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
        $dataSensor = Sensor::orderBy('created_at', 'DESC')->get();

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

    public function kirimDataSensor(Request $request)
    {
        $distance = $request->input('distance');
        $windSpeed = $request->input('wind_speed');
        $winstatusdSpeed = $request->input('status');
        // Lakukan pemrosesan data ultrasonik, misalnya menyimpan ke database atau melakukan tindakan lainnya
        $data = [
            'tanggal' => date('Y-m-d'),
            'sensor' => $distance,
            'wind_speed' => $windSpeed,
            'status' => $winstatusdSpeed,
        ];

        Sensor::create($data);

        return response()->json(['status' => 'success']);
    }

}
