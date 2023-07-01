<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function getData($start, $end)
    {
        $data = [];
        $i = 1;

        $sensors = Sensor::whereBetween('tanggal', [$start, $end])->get();

        if ($sensors->isEmpty()) {
            $data[] = [
                'DT_RowIndex' => '',
                'tanggal' => '',
                'ketinggian' => '',
                'kecepatan' => '',
                'suhu' => '',
                'humidity' => '',
            ];
        } else {
            foreach ($sensors as $sensor) {
                $row = [];
                $row['DT_RowIndex'] = $i++;
                $row['tanggal'] = tanggal_indonesia($sensor->created_at, strtotime($sensor->created_at)) . ' ' . date('H:I:s', strtotime($sensor->created_at));
                $row['ketinggian'] = $sensor->sensor . ' cm <br> dari permukaan air';
                $row['kecepatan'] = $sensor->weend_speed . ' m/s';
                $row['suhu'] = $sensor->suhu . ' °C';
                $row['humidity'] = $sensor->kelembaban . ' %';

                $data[] = $row;
            }
        }

        return $data;
    }

    public function exportPDF($start, $end)
    {
        $data = $this->getData($start, $end);
        $pdf = PDF::loadView('report.index', compact('start', 'end', 'data'));

        return $pdf->download('Laporan_monitoring_data_' . date('Y-m-d-his') . '.pdf');
    }
}
