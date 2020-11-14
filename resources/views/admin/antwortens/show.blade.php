@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.antworten.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.antwortens.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.antworten.fields.id') }}
                        </th>
                        <td>
                            {{ $antworten->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.antworten.fields.question') }}
                        </th>
                        <td>
                            {{ $antworten->question->question ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.antworten.fields.answer') }}
                        </th>
                        <td>
                            {{ $antworten->answer }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.antwortens.index') }}">
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
            <a class="nav-link" href="#answers_bewerbers" role="tab" data-toggle="tab">
                {{ trans('cruds.bewerber.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="answers_bewerbers">
            @includeIf('admin.antwortens.relationships.answersBewerbers', ['bewerbers' => $antworten->answersBewerbers])
        </div>
    </div>
</div>

@endsection