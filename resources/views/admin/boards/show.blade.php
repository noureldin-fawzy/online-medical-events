@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.board.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.board.fields.id') }}
                        </th>
                        <td>
                            {{ $board->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.board.fields.event') }}
                        </th>
                        <td>
                            @foreach($board->events as $key => $event)
                                <span class="label label-info">{{ $event->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.board.fields.type') }}
                        </th>
                        <td>
                            {{ App\Models\Board::TYPE_SELECT[$board->type] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.board.fields.title') }}
                        </th>
                        <td>
                            {{ $board->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.board.fields.name') }}
                        </th>
                        <td>
                            {{ $board->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.board.fields.image') }}
                        </th>
                        <td>
                            @if($board->image)
                                <a href="{{ $board->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $board->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.board.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $board->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.boards.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection