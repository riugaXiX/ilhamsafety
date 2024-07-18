<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dht;
class DhtController extends Controller
{
    //
    public function index(){
        return view('admin/pages/dht', [
            "title" => "dht",
            "dhts" => Dht::all()
        ]);
    } 

    public function store(Request $request)
    {
        $data = $request->validate([
            'suhu' => 'required',
            'kelembapan' => 'required',
        ]);

        Dht::create($data);

    }

    public function destroy($id){
        $post = Dht::findOrFail($id);
        $post->delete();

        return redirect('/dht22')->with('success', 'Data has been deleted successfully!');
    
    }
}
