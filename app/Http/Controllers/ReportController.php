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
            ];
        } else {
            foreach ($sensors as $sensor) {

                //  var tinggiMaxAquarium = 2500;
                //     // mengukur tinggi air
                //     var tinggiAir = tinggiMaxAquarium - data.sensor;
                //     // presentasi ketinggian air
                //     var presentaseTinggiAir = (tinggiAir/tinggiMaxAquarium)*100; // hasil
                $row = [];
                $row['DT_RowIndex'] = $i++;
                $row['tanggal'] = tanggal_indonesia($sensor->created_at, strtotime($sensor->created_at)) . ' ' . date('H:I:s', strtotime($sensor->created_at));
                $row['ketinggian'] = $sensor->sensor . ' cm <br> dari permukaan air';
                $row['kecepatan'] = $sensor->weend_speed . ' m/s';

                $data[] = $row;
            }
        }

        return $data;
    }

    public function data($start, $end)
    {
        $data = $this->getData($start, $end);

        return datatables($data)
            ->escapeColumns([])
            ->make(true);
    }

    public function exportPDF($start, $end)
    {
        $data = $this->getData($start, $end);
        $pdf = PDF::loadView('report.index', compact('start', 'end', 'data'));

        return $pdf->stream('Laporan-monitoring-data-ketingian-kecepatan-' . date('Y-m-d-his') . '.pdf');
    }
}
