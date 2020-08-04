<?php

namespace App\Http\Requests;

use App\Models\ExhibitionDetail;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyExhibitionDetailRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('exhibition_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:exhibition_details,id',
        ];
    }
}
