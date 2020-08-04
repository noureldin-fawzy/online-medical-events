@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.exhibition.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.exhibitions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibition.fields.id') }}
                        </th>
                        <td>
                            {{ $exhibition->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibition.fields.event') }}
                        </th>
                        <td>
                            {{ $exhibition->event->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibition.fields.title') }}
                        </th>
                        <td>
                            {{ $exhibition->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibition.fields.image') }}
                        </th>
                        <td>
                            @if($exhibition->image)
                                <a href="{{ $exhibition->image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $exhibition->image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibition.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $exhibition->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.exhibitions.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#exhibition_exhibition_details" role="tab" data-toggle="tab">
                {{ trans('cruds.exhibitionDetail.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="exhibition_exhibition_details">
            @includeIf('admin.exhibitions.relationships.exhibitionExhibitionDetails', ['exhibitionDetails' => $exhibition->exhibitionExhibitionDetails])
        </div>
    </div>
</div>

@endsection