@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.job.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.id') }}
                        </th>
                        <td>
                            {{ $job->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.job_nr') }}
                        </th>
                        <td>
                            {{ $job->job_nr }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.jobtitle') }}
                        </th>
                        <td>
                            {{ $job->jobtitle }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.status') }}
                        </th>
                        <td>
                            {{ App\Job::STATUS_SELECT[$job->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.questions') }}
                        </th>
                        <td>
                            @foreach($job->questions as $key => $questions)
                                <span class="label label-info">{{ $questions->question }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.anmerkungen') }}
                        </th>
                        <td>
                            {{ $job->anmerkungen }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.milestone_1') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $job->milestone_1 ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.milestone_2') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $job->milestone_2 ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.milestone_3') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $job->milestone_3 ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.created_at') }}
                        </th>
                        <td>
                            {{ $job->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $job->updated_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.job.fields.deleted_at') }}
                        </th>
                        <td>
                            {{ $job->deleted_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.jobs.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#job_bewerbers" role="tab" data-toggle="tab">
                {{ trans('cruds.bewerber.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="job_bewerbers">
            @includeIf('admin.jobs.relationships.jobBewerbers', ['bewerbers' => $job->jobBewerbers])
        </div>
    </div>
</div>

@endsection