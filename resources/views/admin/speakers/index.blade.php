@extends('layouts.admin')
@section('content')
@can('speaker_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.speakers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.speaker.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Speaker', 'route' => 'admin.speakers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.speaker.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Speaker">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.speaker.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.speaker.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.speaker.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.speaker.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.speaker.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.speaker.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($events as $key => $item)
                                    <option value="{{ $item->title }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                            <input class="search" type="text" placeholder="{{ trans('global.search') }}">
                        </td>
                        <td>
                        </td>
                        <td>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($speakers as $key => $speaker)
                        <tr data-entry-id="{{ $speaker->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $speaker->id ?? '' }}
                            </td>
                            <td>
                                {{ $speaker->event->title ?? '' }}
                            </td>
                            <td>
                                {{ $speaker->title ?? '' }}
                            </td>
                            <td>
                                {{ $speaker->name ?? '' }}
                            </td>
                            <td>
                                {{ $speaker->email ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $speaker->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $speaker->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('speaker_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.speakers.show', $speaker->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('speaker_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.speakers.edit', $speaker->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('speaker_delete')
                                    <form action="{{ route('admin.speakers.destroy', $speaker->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('speaker_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.speakers.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Speaker:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  $('.datatable thead').on('input', '.search', function () {
      let strict = $(this).attr('strict') || false
      let value = strict && this.value ? "^" + this.value + "$" : this.value
      table
        .column($(this).parent().index())
        .search(value, strict)
        .draw()
  });
})

</script>
@endsection