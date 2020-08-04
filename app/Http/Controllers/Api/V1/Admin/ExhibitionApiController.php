<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreExhibitionRequest;
use App\Http\Requests\UpdateExhibitionRequest;
use App\Http\Resources\Admin\ExhibitionResource;
use App\Models\Exhibition;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ExhibitionApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('exhibition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExhibitionResource(Exhibition::with(['event'])->get());
    }

    public function store(StoreExhibitionRequest $request)
    {
        $exhibition = Exhibition::create($request->all());

        if ($request->input('image', false)) {
            $exhibition->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new ExhibitionResource($exhibition))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Exhibition $exhibition)
    {
        abort_if(Gate::denies('exhibition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ExhibitionResource($exhibition->load(['event']));
    }

    public function update(UpdateExhibitionRequest $request, Exhibition $exhibition)
    {
        $exhibition->update($request->all());

        if ($request->input('image', false)) {
            if (!$exhibition->image || $request->input('image') !== $exhibition->image->file_name) {
                if ($exhibition->image) {
                    $exhibition->image->delete();
                }

                $exhibition->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($exhibition->image) {
            $exhibition->image->delete();
        }

        return (new ExhibitionResource($exhibition))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Exhibition $exhibition)
    {
        abort_if(Gate::denies('exhibition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibition->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
