@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.organizer.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.organizer.fields.id') }}
                        </th>
                        <td>
                            {{ $organizer->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizer.fields.event') }}
                        </th>
                        <td>
                            @foreach($organizer->events as $key => $event)
                                <span class="label label-info">{{ $event->title }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizer.fields.title') }}
                        </th>
                        <td>
                            {{ $organizer->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizer.fields.logo') }}
                        </th>
                        <td>
                            @if($organizer->logo)
                                <a href="{{ $organizer->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $organizer->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.organizer.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $organizer->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.organizers.index') }}">
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
            <a class="nav-link" href="#organizer_contacts" role="tab" data-toggle="tab">
                {{ trans('cruds.contact.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="organizer_contacts">
            @includeIf('admin.organizers.relationships.organizerContacts', ['contacts' => $organizer->organizerContacts])
        </div>
    </div>
</div>

@endsection