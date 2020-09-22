<?php

namespace App\Service;

use App\Interfaces\Commentable;
use Illuminate\Http\Request;

class AddCommentService
{
    public static function addComment(Request $request, Commentable $commentable)
    {
        $validatedData = $request->validate([
            'text' => 'required|unique:comments|min:50|max:255',
        ]);

        $commentable->comments()->create(['user_id' => \Auth::id(), 'text' => $validatedData['text']]);

        flash('Комментарий добавлен успешно.');
    }
}