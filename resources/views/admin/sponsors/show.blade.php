@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.sponsor.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sponsors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.sponsor.fields.id') }}
                        </th>
                        <td>
                            {{ $sponsor->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sponsor.fields.event') }}
                        </th>
                        <td>
                            @foreach($sponsor->events as $key => $event)
                                <span class="label label-info">{{ $event->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sponsor.fields.title') }}
                        </th>
                        <td>
                            {{ $sponsor->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sponsor.fields.logo') }}
                        </th>
                        <td>
                            @if($sponsor->logo)
                                <a href="{{ $sponsor->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $sponsor->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.sponsor.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $sponsor->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.sponsors.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection