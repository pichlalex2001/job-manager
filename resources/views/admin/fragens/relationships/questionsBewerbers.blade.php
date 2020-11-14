<div class="m-3">
    @can('bewerber_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('admin.bewerbers.create') }}">
                    {{ trans('global.add') }} {{ trans('cruds.bewerber.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.bewerber.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-questionsBewerbers">
                    <thead>
                        <tr>
                            <th width="10">

                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.tel') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.job') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.status') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.questions') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.answers') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.created_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.updated_at') }}
                            </th>
                            <th>
                                {{ trans('cruds.bewerber.fields.team') }}
                            </th>
                            <th>
                                &nbsp;
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bewerbers as $key => $bewerber)
                            <tr data-entry-id="{{ $bewerber->id }}">
                                <td>

                                </td>
                                <td>
                                    {{ $bewerber->name ?? '' }}
                                </td>
                                <td>
                                    {{ $bewerber->email ?? '' }}
                                </td>
                                <td>
                                    {{ $bewerber->tel ?? '' }}
                                </td>
                                <td>
                                    {{ $bewerber->job->job_nr ?? '' }}
                                </td>
                                <td>
                                    {{ App\Bewerber::STATUS_SELECT[$bewerber->status] ?? '' }}
                                </td>
                                <td>
                                    @foreach($bewerber->questions as $key => $item)
                                        <span class="badge badge-info">{{ $item->question }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($bewerber->answers as $key => $item)
                                        <span class="badge badge-info">{{ $item->answer }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    {{ $bewerber->created_at ?? '' }}
                                </td>
                                <td>
                                    {{ $bewerber->updated_at ?? '' }}
                                </td>
                                <td>
                                    {{ $bewerber->team->name ?? '' }}
                                </td>
                                <td>
                                    @can('bewerber_show')
                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.bewerbers.show', $bewerber->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan

                                    @can('bewerber_edit')
                                        <a class="btn btn-xs btn-info" href="{{ route('admin.bewerbers.edit', $bewerber->id) }}">
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
    order: [[ 8, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-questionsBewerbers:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection