<?php

namespace App\Http\Controllers;

use App\Models\Sensor;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $start = now()->subDays(30)->format('Y-m-d');
        $end = date('Y-m-d');

        if ($request->has('start') && $request->start != "" && $request->has('end') && $request->end != "") {
            $start = $request->start;
            $end = $request->end;
        }

        return view('report.index', compact('start', 'end'));
    }

    public function getData($start, $end, $escape = false)
    {
        $data = [];
        $i = 1;

        while (strtotime($start) <= strtotime($end)) {
            $distance = Sensor::where('tanggal', 'LIKE', "%$start%")
                ->get();

            $row = [];
            $row['DT_RowIndex'] = $i++;
            $row['tanggal'] = tanggal_indonesia($start);
            $row['distance'] = $distance->sensor;
            $row['status'] = $distance->status;
            $row['kecepatan'] = $distance->weend_speed;

            array_push($data, $row);

            $start = date('Y-m-d', strtotime('+1 day', strtotime($start)));
        }

        $data[] = [
            'DT_RowIndex' => '',
            'tanggal' => '',
            'distance' => '',
            'status' => '',
            'kecepatan' => '',
        ];

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
        $pdf = PDF::loadView('report.pdf', compact('start', 'end', 'data'));

        return $pdf->stream('Laporan-monitoring-data-ketingian-kecepatan-' . date('Y-m-d-his') . '.pdf');
    }
}
