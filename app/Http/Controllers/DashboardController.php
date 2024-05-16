<?php
namespace App\Http\Controllers;

use App\Charts\dhtchart;
use App\Charts\flamechart;
use App\Charts\gaschart;
use App\Charts\teschart;
use App\Charts\userchart;
use Illuminate\Http\Request;
use App\Models\Flame;
use App\Models\Dht;
use App\Models\Gas;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class DashboardController extends Controller
{
    public function index(dhtchart $chart, flamechart $chart2, gaschart $chart3, userchart $chart4)
    {
        $totaldataflame = Flame::count();
        $totaldatadht = Dht::count();
        $totaldatauser = User::count();
        $totaldatagas = Gas::count();

        // Mengambil data suhu dari model Dht
        $dhtData = Dht::all();
        $temperatures = $dhtData->pluck('suhu')->toArray();
        $timestamps = $dhtData->pluck('created_at')->toArray();

        // Membuat chart suhu
        $temperatureChart = (new LarapexChart)->lineChart()
            ->setTitle('Temperature Data')
            ->addData('Temperature', $temperatures)
            ->setXAxis($timestamps);

        return view('admin.pages.dashboard', [
            "title" => 'dashboard',
            "totaldataflame" => $totaldataflame,
            "totaldatadht" => $totaldatadht,
            "totaldatauser" => $totaldatauser,
            "totaldatagas" => $totaldatagas,
            "chart" => $chart->build(),
            "chart2" => $chart2->build(),
            "chart3" => $chart3->build(),
            "chart4" => $chart4->build()

        ]);
    }
}
