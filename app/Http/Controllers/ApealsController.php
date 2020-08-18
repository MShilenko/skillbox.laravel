<?php

namespace App\Http\Controllers;

use App\Apeals;
use Illuminate\Http\Request;

class ApealsController extends Controller
{
    public function index()
    {
        return view('apeals.index', ['apeals' => Apeals::latest()->get()]);
    }

    public function create()
    {
        return view('apeals.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => ['required'],
            'message' => ['required'],
        ]);

        Apeals::create($validatedData);

        return redirect('/admin/feedbacks');
    }
}
