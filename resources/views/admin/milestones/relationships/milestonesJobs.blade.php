<div class="m-3">
    @can('job_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.jobs.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.job.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.job.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-milestonesJobs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.job.fields.job_nr') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.anmerkungen') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.questions') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.milestones') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $key => $job)
                            <tr data-entry-id="{{ $job->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $job->job_nr ?? '' }}
                                </td>
                                <td>
                                    {{ App\Job::STATUS_SELECT[$job->status] ?? '' }}
                                </td>
                                <td>
                                    {{ $job->anmerkungen ?? '' }}
                                </td>
                                <td>
                                    @foreach($job->questions as $key => $item)
                                        <span class="badge badge-info">{{ $item->question }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($job->milestones as $key => $item)
                                        <span class="badge badge-info">{{ $item->milestone_1 }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @can('job_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.jobs.show', $job->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('job_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.jobs.edit', $job->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan

                                    @can('job_delete')
                                        <form action="{{ route('admin.jobs.destroy', $job->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
</div>
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('job_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.jobs.massDestroy') }}",
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
  let table = $('.datatable-milestonesJobs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection