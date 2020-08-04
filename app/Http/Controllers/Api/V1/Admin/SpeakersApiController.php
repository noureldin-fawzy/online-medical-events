<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreSpeakerRequest;
use App\Http\Requests\UpdateSpeakerRequest;
use App\Http\Resources\Admin\SpeakerResource;
use App\Models\Speaker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SpeakersApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('speaker_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpeakerResource(Speaker::with(['event'])->get());
    }

    public function store(StoreSpeakerRequest $request)
    {
        $speaker = Speaker::create($request->all());

        if ($request->input('image', false)) {
            $speaker->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($request->input('cv', false)) {
            $speaker->addMedia(storage_path('tmp/uploads/' . $request->input('cv')))->toMediaCollection('cv');
        }

        return (new SpeakerResource($speaker))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Speaker $speaker)
    {
        abort_if(Gate::denies('speaker_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new SpeakerResource($speaker->load(['event']));
    }

    public function update(UpdateSpeakerRequest $request, Speaker $speaker)
    {
        $speaker->update($request->all());

        if ($request->input('image', false)) {
            if (!$speaker->image || $request->input('image') !== $speaker->image->file_name) {
                if ($speaker->image) {
                    $speaker->image->delete();
                }

                $speaker->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($speaker->image) {
            $speaker->image->delete();
        }

        if ($request->input('cv', false)) {
            if (!$speaker->cv || $request->input('cv') !== $speaker->cv->file_name) {
                if ($speaker->cv) {
                    $speaker->cv->delete();
                }

                $speaker->addMedia(storage_path('tmp/uploads/' . $request->input('cv')))->toMediaCollection('cv');
            }
        } elseif ($speaker->cv) {
            $speaker->cv->delete();
        }

        return (new SpeakerResource($speaker))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Speaker $speaker)
    {
        abort_if(Gate::denies('speaker_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $speaker->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
