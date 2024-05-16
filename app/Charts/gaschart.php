<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;
use App\models\Gas;

class gaschart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = Gas::latest()->take(10)->get();
        $gas = $data->pluck('gas')->toArray(); // Asumsi kolom 'gas' ada di tabel Dht
        $times = $data->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i:s');
        })->toArray();

        return $this->chart->lineChart()
            ->setTitle('gas')
            ->setSubtitle('10 Data terbaru')
            ->addData('Gas', $gas)
            ->setXAxis($times);
    }
}
