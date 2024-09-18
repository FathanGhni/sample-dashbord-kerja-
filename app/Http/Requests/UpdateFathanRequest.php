<?php

namespace App\Http\Requests;

use App\Models\Fathan;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateFathanRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('fathan_edit');
    }

    public function rules()
    {
        return [
            // 'bookname' => [
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
