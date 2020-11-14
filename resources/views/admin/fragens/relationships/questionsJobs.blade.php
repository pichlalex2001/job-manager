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
                <table class=" table table-bordered table-striped table-hover datatable datatable-questionsJobs">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.job.fields.job_nr') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.jobtitle') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.questions') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.anmerkungen') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.milestone_1') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.milestone_2') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.milestone_3') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.updated_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.job.fields.team') }}
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
                                    {{ $job->jobtitle ?? '' }}
                                </td>
                                <td>
                                    {{ App\Job::STATUS_SELECT[$job->status] ?? '' }}
                                </td>
                                <td>
                                    @foreach($job->questions as $key => $item)
                                        <span class="badge badge-info">{{ $item->question }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $job->anmerkungen ?? '' }}
                                </td>
                                <td>
                                    <span style="display:none">{{ $job->milestone_1 ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $job->milestone_1 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $job->milestone_2 ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $job->milestone_2 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    <span style="display:none">{{ $job->milestone_3 ?? '' }}</span>
                                    <input type="checkbox" disabled="disabled" {{ $job->milestone_3 ? 'checked' : '' }}>
                                </td>
                                <td>
                                    {{ $job->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $job->updated_at ?? '' }}
                                </td>
                                <td>
                                    {{ $job->team->name ?? '' }}
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-questionsJobs:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection