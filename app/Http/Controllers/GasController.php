<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gas;

class GasController extends Controller
{
    //
    public function index(){
        return view('admin/pages/mq', [
            "title" => "gas",
            "gases" => Gas::all()
            
            
        ]);
    } 

    public function store(Request $request)
    {
        $data = $request->validate([
            'gas' => 'required',
        ]);

        Gas::create($data);

    }

    public function destroy($id){
        $post = Gas::findOrFail($id);
        $post->delete();

        return redirect('/dht22')->with('success', 'Data has been deleted successfully!');
    
    }
}
