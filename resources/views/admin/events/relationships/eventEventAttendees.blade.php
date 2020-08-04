<div class="card">
    <div class="card-header">
        {{ trans('cruds.eventAttendee.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-eventEventAttendees">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.eventAttendee.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventAttendee.fields.event') }}
                        </th>
                        <th>
                            {{ trans('cruds.eventAttendee.fields.user') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($eventAttendees as $key => $eventAttendee)
                        <tr data-entry-id="{{ $eventAttendee->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $eventAttendee->id ?? '' }}
                            </td>
                            <td>
                                {{ $eventAttendee->event->title ?? '' }}
                            </td>
                            <td>
                                {{ $eventAttendee->user->name ?? '' }}
                            </td>
                            <td>
                                @can('event_attendee_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.event-attendees.show', $eventAttendee->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan


                                @can('event_attendee_delete')
                                    <form action="{{ route('admin.event-attendees.destroy', $eventAttendee->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('event_attendee_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.event-attendees.massDestroy') }}",
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
  let table = $('.datatable-eventEventAttendees:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection