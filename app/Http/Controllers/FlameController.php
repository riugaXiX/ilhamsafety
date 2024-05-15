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
            "dhts" => Flame::all()
            
            
        ]);
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
