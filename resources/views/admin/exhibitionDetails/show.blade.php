@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.exhibitionDetail.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.exhibition-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibitionDetail.fields.id') }}
                        </th>
                        <td>
                            {{ $exhibitionDetail->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibitionDetail.fields.exhibition') }}
                        </th>
                        <td>
                            {{ $exhibitionDetail->exhibition->title ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibitionDetail.fields.title') }}
                        </th>
                        <td>
                            {{ $exhibitionDetail->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibitionDetail.fields.media') }}
                        </th>
                        <td>
                            @foreach($exhibitionDetail->media as $key => $media)
                                <a href="{{ $media->getUrl() }}" target="_blank">
                                    {{ trans('global.view_file') }}
                                </a>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.exhibitionDetail.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $exhibitionDetail->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.exhibition-details.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection