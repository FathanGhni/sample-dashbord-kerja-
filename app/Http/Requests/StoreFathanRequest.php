<?php

namespace App\Http\Requests;

use App\Models\Fathan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreFathanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fathan_create');
    }

    public function rules()
    {
        return [
            // 'name' => [
            //     'string',
            //     'required',
            // ],
            // 'author' => [
            //     'string',
            //     'required',
            // ],
        ];
    }
}
