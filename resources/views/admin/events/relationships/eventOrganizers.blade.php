@can('organizer_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.organizers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.organizer.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.organizer.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventOrganizers">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.organizer.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.organizer.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.organizer.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.organizer.fields.logo') }}
                        </th>
                        <th>
                            {{ trans('cruds.organizer.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizers as $key => $organizer)
                        <tr data-entry-id="{{ $organizer->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $organizer->id ?? '' }}
                            </td>
                            <td>
                                @foreach($organizer->events as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ $organizer->title ?? '' }}
                            </td>
                            <td>
                                @if($organizer->logo)
                                    <a href="{{ $organizer->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $organizer->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                <span style="display:none">{{ $organizer->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $organizer->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('organizer_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.organizers.show', $organizer->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('organizer_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.organizers.edit', $organizer->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('organizer_delete')
                                    <form action="{{ route('admin.organizers.destroy', $organizer->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('organizer_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.organizers.massDestroy') }}",
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
  let table = $('.datatable-eventOrganizers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection