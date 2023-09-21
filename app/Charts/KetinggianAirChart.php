<?php

namespace App\Charts;

use App\Models\Sensor;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KetinggianAirChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $data = Sensor::select('sensor')->latest()->first();
        // dd($data);
        return $this->chart->barChart()
            ->setTitle('Grafik Ketinggian Air.')
            ->setSubtitle('Wins during season 2021.')
            ->addData('Boston', [$data])
            ->setXAxis(['January', 'February', 'March', 'April', 'May', 'June']);
    }
}
