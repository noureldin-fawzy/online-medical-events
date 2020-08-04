@can('topic_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.topics.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.topic.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.topic.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventTopics">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.topic.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.topic.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.topic.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.topic.fields.active') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($topics as $key => $topic)
                        <tr data-entry-id="{{ $topic->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $topic->id ?? '' }}
                            </td>
                            <td>
                                {{ $topic->event->title ?? '' }}
                            </td>
                            <td>
                                {{ $topic->title ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $topic->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $topic->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                @can('topic_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.topics.show', $topic->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('topic_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.topics.edit', $topic->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('topic_delete')
                                    <form action="{{ route('admin.topics.destroy', $topic->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('topic_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.topics.massDestroy') }}",
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
  let table = $('.datatable-eventTopics:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection