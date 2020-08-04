@extends('layouts.admin')
@section('content')
@can('sponsor_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.sponsors.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.sponsor.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Sponsor', 'route' => 'admin.sponsors.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.sponsor.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Sponsor">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.sponsor.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.sponsor.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.sponsor.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.sponsor.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.sponsor.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sponsors as $key => $sponsor)
                        <tr data-entry-id="{{ $sponsor->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $sponsor->id ?? '' }}
                            </td>
                            <td>
                                @foreach($sponsor->events as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $sponsor->title ?? '' }}
                            </td>
                            <td>
                                @if($sponsor->logo)
                                    <a href="{{ $sponsor->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $sponsor->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="display:none">{{ $sponsor->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $sponsor->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('sponsor_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.sponsors.show', $sponsor->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('sponsor_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.sponsors.edit', $sponsor->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('sponsor_delete')
                                    <form action="{{ route('admin.sponsors.destroy', $sponsor->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('sponsor_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.sponsors.massDestroy') }}",
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
  let table = $('.datatable-Sponsor:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection