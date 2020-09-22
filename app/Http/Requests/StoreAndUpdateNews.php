<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Slug;
use Illuminate\Validation\Rule;

class StoreAndUpdateNews extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     * Rule метод ignore позволят использовать одни и те же правила валидации и при создании(create) и при обновлении(update)
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => ['required', 'min:5', 'max:100'],
            'slug' => ['required', new Slug(), Rule::unique('news', 'slug')->ignore($this->news)],
            'excerpt' => ['required', 'max:255'],
            'text' => ['required'],
            'public' => [],
        ];
    }
}