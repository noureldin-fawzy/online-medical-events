<?php

namespace App\Http\Requests;

use App\Models\ExhibitionDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreExhibitionDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('exhibition_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'exhibition_id' => [
                'required',
                'integer',
            ],
            'title'         => [
                'string',
                'required',
            ],
            'media.*'       => [
                'required',
            ],
        ];
    }
}
