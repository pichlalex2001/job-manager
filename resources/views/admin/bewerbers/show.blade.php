@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.bewerber.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bewerbers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.id') }}
                        </th>
                        <td>
                            {{ $bewerber->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.name') }}
                        </th>
                        <td>
                            {{ $bewerber->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.email') }}
                        </th>
                        <td>
                            {{ $bewerber->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.tel') }}
                        </th>
                        <td>
                            {{ $bewerber->tel }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.job') }}
                        </th>
                        <td>
                            {{ $bewerber->job->job_nr ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.status') }}
                        </th>
                        <td>
                            {{ App\Bewerber::STATUS_SELECT[$bewerber->status] ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.questions') }}
                        </th>
                        <td>
                            @foreach($bewerber->questions as $key => $questions)
                                <span class="label label-info">{{ $questions->question }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.answers') }}
                        </th>
                        <td>
                            @foreach($bewerber->answers as $key => $answers)
                                <span class="label label-info">{{ $answers->answer }}</span>
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.created_at') }}
                        </th>
                        <td>
                            {{ $bewerber->created_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.bewerber.fields.updated_at') }}
                        </th>
                        <td>
                            {{ $bewerber->updated_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.bewerbers.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection