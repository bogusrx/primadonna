<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExpenseReport;

class ExpenseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('expenseReport.index', [
          'expenseReports'=>ExpenseReport::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('expenseReport.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validData = $request->validate([
          'title' => 'required|min:5'
        ]);
      //dd($validData);
        $report = new ExpenseReport();
        $report->title = $validData['title'];
        $report->save();

        return redirect('/expense_reports');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseReport $expenseReport)
    {
      return view('expenseReport.show', [
        'report'=>$expenseReport
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //findorfail muestra error 404 y no el fallo como tal, ocultando datos
        $report = ExpenseReport::findorfail($id);
        return view('expenseReport.edit', [
          'report'=>$report
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validData = $request->validate([
          'title' => 'required|min:5'
        ]
          ,['title.required' => 'El titulo no debe ser vacío',
            'title.min' => 'El titulo es mínimo 5 caracteres por favor']);
        //        dd('put update');
        $report = ExpenseReport::find($id);
        $report->title = $request->get('title');
        $report->save();

        return redirect('/expense_reports');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $report = ExpenseReport::find($id);
      $report->delete();

      return redirect('/expense_reports');
    }
    public function confirmDelete($id){
      //dd('confirmando el delete de id: ' . $id);
      $report = ExpenseReport::find($id);
      return view('expenseReport.confirmDelete',[
        'report'=>$report
      ]);
    }
}
