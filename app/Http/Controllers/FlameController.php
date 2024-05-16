<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flame;

class FlameController extends Controller
{
    //
    public function index(){
        return view('admin/pages/flame', [
            "title" => "flame",
            "flames" => Flame::all()
            
            
        ]);
    }

    public function fetchdata(){
        // Periksa apakah ada data baru dengan nilai 0
        $latestFlame = Flame::latest()->first();
        if ($latestFlame && $latestFlame->api == 0) {
            return response()->json(['alert' => 'Ada api terdeteksi']);
        }

        return response()->json(['message' => 'Tidak ada data baru']);
    }

    public function tambah(){
        return view(
            'admin.pages.tambah.flametesting', [
            "title" => "mamank"
            ]
        );
    }

    public function store(Request $request){
        $data = $request->validate([
            'api' => 'required'
        ]);

        Flame::create($data);
    }
    public function destroy($id){
        $post = Flame::findOrFail($id);
        $post->delete();

        return redirect('/flame')->with('success', 'Data has been deleted successfully!');
    
    }
}
