<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use Illuminate\Support\Carbon;
use App\Models\User;
class userchart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $users = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
        ->groupBy('date')
        ->orderBy('date', 'desc')
        ->take(10)
        ->get()
        ->reverse();

        $dates = $users->pluck('date')->map(function ($date) {
            return Carbon::parse($date)->format('d M');
        })->toArray();

        $counts = $users->pluck('count')->toArray();

        return $this->chart->lineChart()
            ->setTitle('Users')
            // ->setSubtitle('Daily Registrations')
            ->addData('Users', $counts)
            ->setXAxis($dates);
        }
}
