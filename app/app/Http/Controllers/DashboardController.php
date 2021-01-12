<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //media entre la vista y la llamada inicial desde web
    public function index(Request $request){
      //var_dump($request->input('titulo','valor default'));die;
      //dd($request->input('titulo','valor default'));
      //dump($request);die;
      return view('test', [
        'titulo' => $request->input('titulo','valor default')
      ]);
    }

}
