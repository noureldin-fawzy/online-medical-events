@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.topic.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.topics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.topic.fields.id') }}
                        </th>
                        <td>
                            {{ $topic->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.topic.fields.event') }}
                        </th>
                        <td>
                            {{ $topic->event->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.topic.fields.title') }}
                        </th>
                        <td>
                            {{ $topic->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.topic.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $topic->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.topics.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection