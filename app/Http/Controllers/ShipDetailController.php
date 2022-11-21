<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShipDetailController extends Controller
{
    public function test(Request $request){
        return response()->json($request->all());
    }
}
