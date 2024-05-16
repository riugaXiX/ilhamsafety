<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;
use App\models\Dht;
class dhtchart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = Dht::latest()->take(10)->get();
        $suhu = $data->pluck('Suhu')->toArray(); // Asumsi kolom 'suhu' ada di tabel Dht
        $times = $data->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i:s');
        })->toArray();

        return $this->chart->lineChart()
            ->setTitle('Suhu')
            ->setSubtitle('10 Data terbaru')
            ->addData('Suhu', $suhu)
            ->setXAxis($times);
    }
}
