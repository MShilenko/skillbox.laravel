<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function store(Request $request) 
    {
        $availableModels = ['App\Post', 'App\News'];

        if (!in_array($request->model, $availableModels)) {
            flash('Произошла ошибка при сохранении.', 'danger');
            return back()->withInput();
        }

        if (!$post = $request->model::find($request->id)) {
            flash('Произошла ошибка при сохранении.', 'danger');
            return back()->withInput();
        }

        $validatedData = $request->validate([
            'text' => 'required|unique:comments|min:50|max:255',
        ]);

        $post->comments()->create(['user_id' => Auth::id(), 'text' => $validatedData['text']]);

        flash('Комментарий добавлен успешно.');

        return back();
    }
}
