<?php

namespace App\Http\Requests;

use App\Models\Beasiswa;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBeasiswaRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('product_create');
    }

    public function rules()
    {
        return [
            // 'name' => [
            //     'string',
            //     'nullable',
            // ],
            // 'description' => [
            //     'string',
            //     'nullable',
            // ],
            // 'stock' => [
            //     'nullable',
            //     'integer',
            //     'min:-2147483648',
            //     'max:2147483647',
            // ],
        ];
    }
}
