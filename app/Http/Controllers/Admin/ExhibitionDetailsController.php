<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyExhibitionDetailRequest;
use App\Http\Requests\StoreExhibitionDetailRequest;
use App\Http\Requests\UpdateExhibitionDetailRequest;
use App\Models\Exhibition;
use App\Models\ExhibitionDetail;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ExhibitionDetailsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('exhibition_detail_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibitionDetails = ExhibitionDetail::all();

        return view('admin.exhibitionDetails.index', compact('exhibitionDetails'));
    }

    public function create()
    {
        abort_if(Gate::denies('exhibition_detail_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibitions = Exhibition::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.exhibitionDetails.create', compact('exhibitions'));
    }

    public function store(StoreExhibitionDetailRequest $request)
    {
        $exhibitionDetail = ExhibitionDetail::create($request->all());

        foreach ($request->input('media', []) as $file) {
            $exhibitionDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('media');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $exhibitionDetail->id]);
        }

        return redirect()->route('admin.exhibition-details.index');
    }

    public function edit(ExhibitionDetail $exhibitionDetail)
    {
        abort_if(Gate::denies('exhibition_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibitions = Exhibition::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exhibitionDetail->load('exhibition');

        return view('admin.exhibitionDetails.edit', compact('exhibitions', 'exhibitionDetail'));
    }

    public function update(UpdateExhibitionDetailRequest $request, ExhibitionDetail $exhibitionDetail)
    {
        $exhibitionDetail->update($request->all());

        if (count($exhibitionDetail->media) > 0) {
            foreach ($exhibitionDetail->media as $media) {
                if (!in_array($media->file_name, $request->input('media', []))) {
                    $media->delete();
                }
            }
        }

        $media = $exhibitionDetail->media->pluck('file_name')->toArray();

        foreach ($request->input('media', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $exhibitionDetail->addMedia(storage_path('tmp/uploads/' . $file))->toMediaCollection('media');
            }
        }

        return redirect()->route('admin.exhibition-details.index');
    }

    public function show(ExhibitionDetail $exhibitionDetail)
    {
        abort_if(Gate::denies('exhibition_detail_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibitionDetail->load('exhibition');

        return view('admin.exhibitionDetails.show', compact('exhibitionDetail'));
    }

    public function destroy(ExhibitionDetail $exhibitionDetail)
    {
        abort_if(Gate::denies('exhibition_detail_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibitionDetail->delete();

        return back();
    }

    public function massDestroy(MassDestroyExhibitionDetailRequest $request)
    {
        ExhibitionDetail::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('exhibition_detail_create') && Gate::denies('exhibition_detail_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new ExhibitionDetail();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
