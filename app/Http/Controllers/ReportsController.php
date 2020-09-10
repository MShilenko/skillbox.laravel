<?php

namespace App\Http\Controllers;

use App\Jobs\EntitiesCounting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ReportsController extends Controller
{
    public function index()
    {
        return view('admin.reports.index');
    }

    public function send(Request $request)
    {
        if (!$request->has(['models'])) {
            flash('Не выбрна ни одни параметр.', 'danger');
            return back()->withInput();            
        }
        
        EntitiesCounting::dispatch($request->models)->onQueue('reports');

        flash('Отчет отправлен!');

        return redirect(route('admin.reports'));
    }
}
