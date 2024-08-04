<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookParking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class BookParkingController extends Controller {

    public function table_data() {
        $data = BookParking::all();
        return view('/', compact('data'));

    }
    public function addtest(Request $request){
        $data = $request->all();
        BookParking::create([
        'Day' => $data['day'],
        'Number' => $data['number'],
       ]);
       return redirect('/');
   }


    public function update(Request $request)
    {
    $data = BookParking::where('Day','=', $request->day)->firstorFail();
    $data->Number = $request->number;
    $data->save();

    return redirect('/');
    }

   public function destroy(Request $request){
        BookParking::where('Day', $request->day1)->delete();

       return redirect('/');
   }
}