<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Dht;
class teschart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = Dht::latest()->take(10);
        $temperatures = $data->pluck('suhu')->toArray();
        $dibuat = $data->pluck('created_at')->toArray();


        return $this->chart->lineChart()
            ->setTitle('Sales during 2021.')
            ->setSubtitle('Physical sales vs Digital sales.')
            ->addData('Suhu', $temperatures)
            ->setXAxis($dibuat);
    }
}
