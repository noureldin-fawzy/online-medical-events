@can('board_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.boards.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.board.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.board.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventBoards">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.board.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.board.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.board.fields.type') }}
                        </th>
                        <th>
                            {{ trans('cruds.board.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.board.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.board.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($boards as $key => $board)
                        <tr data-entry-id="{{ $board->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $board->id ?? '' }}
                            </td>
                            <td>
                                @foreach($board->events as $key => $item)
                                    <span class="badge badge-info">{{ $item->title }}</span>
                                @endforeach
                            </td>
                            <td>
                                {{ App\Models\Board::TYPE_SELECT[$board->type] ?? '' }}
                            </td>
                            <td>
                                {{ $board->title ?? '' }}
                            </td>
                            <td>
                                {{ $board->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $board->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $board->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('board_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.boards.show', $board->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('board_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.boards.edit', $board->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('board_delete')
                                    <form action="{{ route('admin.boards.destroy', $board->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('board_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.boards.massDestroy') }}",
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
  let table = $('.datatable-eventBoards:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection