<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreExhibitionDetailRequest;
use App\Http\Requests\UpdateExhibitionDetailRequest;
use App\Http\Resources\Admin\ExhibitionDetailResource;
use App\Models\ExhibitionDetail;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExhibitionDetailsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('exhibition_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExhibitionDetailResource(ExhibitionDetail::with(['exhibition'])->get());
    }

    public function store(StoreExhibitionDetailRequest $request)
    {
        $exhibitionDetail = ExhibitionDetail::create($request->all());

        if ($request->input('media', false)) {
            $exhibitionDetail->addMedia(storage_path('tmp/uploads/' . $request->input('media')))->toMediaCollection('media');
        }

        return (new ExhibitionDetailResource($exhibitionDetail))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(ExhibitionDetail $exhibitionDetail)
    {
        abort_if(Gate::denies('exhibition_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExhibitionDetailResource($exhibitionDetail->load(['exhibition']));
    }

    public function update(UpdateExhibitionDetailRequest $request, ExhibitionDetail $exhibitionDetail)
    {
        $exhibitionDetail->update($request->all());

        if ($request->input('media', false)) {
            if (!$exhibitionDetail->media || $request->input('media') !== $exhibitionDetail->media->file_name) {
                if ($exhibitionDetail->media) {
                    $exhibitionDetail->media->delete();
                }

                $exhibitionDetail->addMedia(storage_path('tmp/uploads/' . $request->input('media')))->toMediaCollection('media');
            }
        } elseif ($exhibitionDetail->media) {
            $exhibitionDetail->media->delete();
        }

        return (new ExhibitionDetailResource($exhibitionDetail))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(ExhibitionDetail $exhibitionDetail)
    {
        abort_if(Gate::denies('exhibition_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibitionDetail->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
