<?php

namespace App\Http\Requests;

use App\Models\City;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateCityRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('city_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'country_id' => [
                'required',
                'integer',
            ],
            'title'      => [
                'string',
                'required',
                'unique:cities,title,' . request()->route('city')->id,
            ],
        ];
    }
}
