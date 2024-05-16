<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;
use App\Models\Flame;
class flamechart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $data = Flame::latest()->take(10)->get();
        $Api = $data->pluck('api')->toArray(); // Asumsi kolom 'Api' ada di tabel Dht
        $times = $data->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('H:i:s');
        })->toArray();

        return $this->chart->lineChart()
            ->setTitle('Api')
            ->setSubtitle('10 Data terbaru')
            ->addData('Api', $Api)
            ->setXAxis($times);
        }
}
