<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Http\Resources\Admin\BoardResource;
use App\Models\Board;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BoardApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('board_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoardResource(Board::with(['events'])->get());
    }

    public function store(StoreBoardRequest $request)
    {
        $board = Board::create($request->all());
        $board->events()->sync($request->input('events', []));

        if ($request->input('image', false)) {
            $board->addMedia(storage_path('tmp/uploads/' . $request->input('image')))->toMediaCollection('image');
        }

        return (new BoardResource($board))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Board $board)
    {
        abort_if(Gate::denies('board_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BoardResource($board->load(['events']));
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

        return (new BoardResource($board))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Board $board)
    {
        abort_if(Gate::denies('board_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $board->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
