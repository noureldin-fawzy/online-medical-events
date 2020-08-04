<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBoardRequest;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Models\Board;
use App\Models\Event;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class BoardController extends Controller
{
    use MediaUploadingTrait, CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('board_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $boards = Board::all();

        $events = Event::get();

        return view('admin.boards.index', compact('boards', 'events'));
    }

    public function create()
    {
        abort_if(Gate::denies('board_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id');

        return view('admin.boards.create', compact('events'));
    }

    public function store(StoreBoardRequest $request)
    {
        $board = Board::create($request->all());
        $board->events()->sync($request->input('events', []));

        if ($request->input('image', false)) {
            $board->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $board->id]);
        }

        return redirect()->route('admin.boards.index');
    }

    public function edit(Board $board)
    {
        abort_if(Gate::denies('board_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id');

        $board->load('events');

        return view('admin.boards.edit', compact('events', 'board'));
    }

    public function update(UpdateBoardRequest $request, Board $board)
    {
        $board->update($request->all());
        $board->events()->sync($request->input('events', []));

        if ($request->input('image', false)) {
            if (!$board->image || $request->input('image') !== $board->image->file_name) {
                if ($board->image) {
                    $board->image->delete();
                }

                $board->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
            }
        } elseif ($board->image) {
            $board->image->delete();
        }

        return redirect()->route('admin.boards.index');
    }

    public function show(Board $board)
    {
        abort_if(Gate::denies('board_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $board->load('events');

        return view('admin.boards.show', compact('board'));
    }

    public function destroy(Board $board)
    {
        abort_if(Gate::denies('board_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $board->delete();

        return back();
    }

    public function massDestroy(MassDestroyBoardRequest $request)
    {
        Board::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('board_create') && Gate::denies('board_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Board();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
