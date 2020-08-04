<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyExhibitionRequest;
use App\Http\Requests\StoreExhibitionRequest;
use App\Http\Requests\UpdateExhibitionRequest;
use App\Models\Event;
use App\Models\Exhibition;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class ExhibitionController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('exhibition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibitions = Exhibition::all();

        $events = Event::get();

        return view('admin.exhibitions.index', compact('exhibitions', 'events'));
    }

    public function create()
    {
        abort_if(Gate::denies('exhibition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.exhibitions.create', compact('events'));
    }

    public function store(StoreExhibitionRequest $request)
    {
        $exhibition = Exhibition::create($request->all());

        if ($request->input('image', false)) {
            $exhibition->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $exhibition->id]);
        }

        return redirect()->route('admin.exhibitions.index');
    }

    public function edit(Exhibition $exhibition)
    {
        abort_if(Gate::denies('exhibition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $exhibition->load('event');

        return view('admin.exhibitions.edit', compact('events', 'exhibition'));
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

        return redirect()->route('admin.exhibitions.index');
    }

    public function show(Exhibition $exhibition)
    {
        abort_if(Gate::denies('exhibition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibition->load('event', 'exhibitionExhibitionDetails');

        return view('admin.exhibitions.show', compact('exhibition'));
    }

    public function destroy(Exhibition $exhibition)
    {
        abort_if(Gate::denies('exhibition_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $exhibition->delete();

        return back();
    }

    public function massDestroy(MassDestroyExhibitionRequest $request)
    {
        Exhibition::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('exhibition_create') && Gate::denies('exhibition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Exhibition();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
