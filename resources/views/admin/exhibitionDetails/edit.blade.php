@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.exhibitionDetail.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.exhibition-details.update", [$exhibitionDetail->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="exhibition_id">{{ trans('cruds.exhibitionDetail.fields.exhibition') }}</label>
                <select class="form-control select2 {{ $errors->has('exhibition') ? 'is-invalid' : '' }}" name="exhibition_id" id="exhibition_id" required>
                    @foreach($exhibitions as $id => $exhibition)
                        <option value="{{ $id }}" {{ ($exhibitionDetail->exhibition ? $exhibitionDetail->exhibition->id : old('exhibition_id')) == $id ? 'selected' : '' }}>{{ $exhibition }}</option>
                    @endforeach
                </select>
                @if($errors->has('exhibition'))
                    <div class="invalid-feedback">
                        {{ $errors->first('exhibition') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.exhibitionDetail.fields.exhibition_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.exhibitionDetail.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $exhibitionDetail->title) }}" required>
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.exhibitionDetail.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="media">{{ trans('cruds.exhibitionDetail.fields.media') }}</label>
                <div class="needsclick dropzone {{ $errors->has('media') ? 'is-invalid' : '' }}" id="media-dropzone">
                </div>
                @if($errors->has('media'))
                    <div class="invalid-feedback">
                        {{ $errors->first('media') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.exhibitionDetail.fields.media_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('active') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="active" value="0">
                    <input class="form-check-input" type="checkbox" name="active" id="active" value="1" {{ $exhibitionDetail->active || old('active', 0) === 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="active">{{ trans('cruds.exhibitionDetail.fields.active') }}</label>
                </div>
                @if($errors->has('active'))
                    <div class="invalid-feedback">
                        {{ $errors->first('active') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.exhibitionDetail.fields.active_helper') }}</span>
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
    var uploadedMediaMap = {}
Dropzone.options.mediaDropzone = {
    url: '{{ route('admin.exhibition-details.storeMedia') }}',
    maxFilesize: 20, // MB
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 20
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="media[]" value="' + response.name + '">')
      uploadedMediaMap[file.name] = response.name
    },
    removedfile: function (file) {
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedMediaMap[file.name]
      }
      $('form').find('input[name="media[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($exhibitionDetail) && $exhibitionDetail->media)
          var files =
            {!! json_encode($exhibitionDetail->media) !!}
              for (var i in files) {
              var file = files[i]
              this.options.addedfile.call(this, file)
              file.previewElement.classList.add('dz-complete')
              $('form').append('<input type="hidden" name="media[]" value="' + file.file_name + '">')
            }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection