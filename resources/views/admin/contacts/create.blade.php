@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.contact.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.contacts.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="organizer_id">{{ trans('cruds.contact.fields.organizer') }}</label>
                <select class="form-control select2 {{ $errors->has('organizer') ? 'is-invalid' : '' }}" name="organizer_id" id="organizer_id" required>
                    @foreach($organizers as $id => $organizer)
                        <option value="{{ $id }}" {{ old('organizer_id') == $id ? 'selected' : '' }}>{{ $organizer }}</option>
                    @endforeach
                </select>
                @if($errors->has('organizer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('organizer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.organizer_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="branch">{{ trans('cruds.contact.fields.branch') }}</label>
                <input class="form-control {{ $errors->has('branch') ? 'is-invalid' : '' }}" type="text" name="branch" id="branch" value="{{ old('branch', '') }}" required>
                @if($errors->has('branch'))
                    <div class="invalid-feedback">
                        {{ $errors->first('branch') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.branch_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.contact.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                @if($errors->has('mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.mobile_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.contact.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}">
                @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="whatsapp">{{ trans('cruds.contact.fields.whatsapp') }}</label>
                <input class="form-control {{ $errors->has('whatsapp') ? 'is-invalid' : '' }}" type="text" name="whatsapp" id="whatsapp" value="{{ old('whatsapp', '') }}">
                @if($errors->has('whatsapp'))
                    <div class="invalid-feedback">
                        {{ $errors->first('whatsapp') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.whatsapp_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="website">{{ trans('cruds.contact.fields.website') }}</label>
                <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" id="website" value="{{ old('website', '') }}">
                @if($errors->has('website'))
                    <div class="invalid-feedback">
                        {{ $errors->first('website') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.website_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.contact.fields.address') }}</label>
                <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" id="address" value="{{ old('address', '') }}">
                @if($errors->has('address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ old('active', 0) == 1 || old('active') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.contact.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.contact.fields.active_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection