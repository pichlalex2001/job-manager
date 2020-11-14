@extends('layouts.admin')
@section('content')
@can('bewerber_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.bewerbers.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.bewerber.title_singular') }}
            </a>
            <button class="btn btn-warning" data-toggle="modal" data-target="#csvImportModal">
                {{ trans('global.app_csvImport') }}
            </button>
            @include('csvImport.modal', ['model' => 'Bewerber', 'route' => 'admin.bewerbers.parseCsvImport'])
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.bewerber.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Bewerber">
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
                    <tr>
                        <td>
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($jobs as $key => $item)
                                    <option value="{{ $item->job_nr }}">{{ $item->job_nr }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search" strict="true">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach(App\Bewerber::STATUS_SELECT as $key => $item)
                                    <option value="{{ $item }}">{{ $item }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($fragens as $key => $item)
                                    <option value="{{ $item->question }}">{{ $item->question }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($antwortens as $key => $item)
                                    <option value="{{ $item->answer }}">{{ $item->answer }}</option>
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
                            <select class="search">
                                <option value>{{ trans('global.all') }}</option>
                                @foreach($teams as $key => $item)
                                    <option value="{{ $item->name }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                        </td>
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



@endsection
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
  let table = $('.datatable-Bewerber:not(.ajaxTable)').DataTable({ buttons: dtButtons })
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