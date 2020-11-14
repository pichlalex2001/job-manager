@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.fragen.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fragens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.fragen.fields.id') }}
                        </th>
                        <td>
                            {{ $fragen->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fragen.fields.question') }}
                        </th>
                        <td>
                            {{ $fragen->question }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fragen.fields.created_at') }}
                        </th>
                        <td>
                            {{ $fragen->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.fragen.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $fragen->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.fragens.index') }}">
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
            <a class="nav-link" href="#question_antwortens" role="tab" data-toggle="tab">
                {{ trans('cruds.antworten.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#questions_jobs" role="tab" data-toggle="tab">
                {{ trans('cruds.job.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#questions_bewerbers" role="tab" data-toggle="tab">
                {{ trans('cruds.bewerber.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="question_antwortens">
            @includeIf('admin.fragens.relationships.questionAntwortens', ['antwortens' => $fragen->questionAntwortens])
        </div>
        <div class="tab-pane" role="tabpanel" id="questions_jobs">
            @includeIf('admin.fragens.relationships.questionsJobs', ['jobs' => $fragen->questionsJobs])
        </div>
        <div class="tab-pane" role="tabpanel" id="questions_bewerbers">
            @includeIf('admin.fragens.relationships.questionsBewerbers', ['bewerbers' => $fragen->questionsBewerbers])
        </div>
    </div>
</div>

@endsection