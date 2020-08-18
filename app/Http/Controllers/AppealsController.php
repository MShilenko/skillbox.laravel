<?php

namespace App\Http\Controllers;

use App\Appeal;
use Illuminate\Http\Request;

class AppealsController extends Controller
{
    public function index()
    {
        return view('apeals.index', ['appeals' => Appeal::latest()->get()]);
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

        Appeal::create($validatedData);

        return redirect(route('admin.feedbacks'));
    }
}
