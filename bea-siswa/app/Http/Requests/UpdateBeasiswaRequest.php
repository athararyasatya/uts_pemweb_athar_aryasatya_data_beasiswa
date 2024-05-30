<?php

namespace App\Http\Requests;

use App\Models\Beasiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateBeasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_edit');
    }

    public function rules()
    {
        // return [
        //     'name' => [
        //         'string',
        //         'nullable',
        //     ],
        //     'description' => [
        //         'string',
        //         'nullable',
        //     ],
        //     'stock' => [
        //         'nullable',
        //         'integer',
        //         'min:-2147483648',
        //         'max:2147483647',
        //     ],
        // ];
    }
}