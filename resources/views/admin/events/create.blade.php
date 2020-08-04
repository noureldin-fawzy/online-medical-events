@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.event.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.events.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="specialty_id">{{ trans('cruds.event.fields.specialty') }}</label>
                <select class="form-control select2 {{ $errors->has('specialty') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id" required>
                    @foreach($specialties as $id => $specialty)
                        <option value="{{ $id }}" {{ old('specialty_id') == $id ? 'selected' : '' }}>{{ $specialty }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.specialty_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.event.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.event.fields.description') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{!! old('description') !!}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_at">{{ trans('cruds.event.fields.start_at') }}</label>
                <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="text" name="start_at" id="start_at" value="{{ old('start_at') }}" required>
                @if($errors->has('start_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.start_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="end_at">{{ trans('cruds.event.fields.end_at') }}</label>
                <input class="form-control datetime {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="text" name="end_at" id="end_at" value="{{ old('end_at') }}">
                @if($errors->has('end_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.end_at_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="link">{{ trans('cruds.event.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}">
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.link_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('notification') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="notification" value="0">
                    <input class="form-check-input" type="checkbox" name="notification" id="notification" value="1" {{ old('notification', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="notification">{{ trans('cruds.event.fields.notification') }}</label>
                </div>
                @if($errors->has('notification'))
                    <div class="invalid-feedback">
                        {{ $errors->first('notification') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.notification_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.event.fields.active') }}</label>
                @foreach(App\Models\Event::ACTIVE_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="active_{{ $key }}" name="active" value="{{ $key }}" {{ old('active', '1') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="active_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.event.fields.active_helper') }}</span>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/admin/events/ckmedia', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', {{ $event->id ?? 0 }});
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

@endsection