@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.job.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jobs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="job_nr">{{ trans('cruds.job.fields.job_nr') }}</label>
                <input class="form-control {{ $errors->has('job_nr') ? 'is-invalid' : '' }}" type="number" name="job_nr" id="job_nr" value="{{ old('job_nr', '') }}" step="1" required>
                @if($errors->has('job_nr'))
                    <span class="text-danger">{{ $errors->first('job_nr') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.job_nr_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="jobtitle">{{ trans('cruds.job.fields.jobtitle') }}</label>
                <input class="form-control {{ $errors->has('jobtitle') ? 'is-invalid' : '' }}" type="text" name="jobtitle" id="jobtitle" value="{{ old('jobtitle', '') }}">
                @if($errors->has('jobtitle'))
                    <span class="text-danger">{{ $errors->first('jobtitle') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.jobtitle_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.job.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Job::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '1') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="questions">{{ trans('cruds.job.fields.questions') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('questions') ? 'is-invalid' : '' }}" name="questions[]" id="questions" multiple>
                    @foreach($questions as $id => $questions)
                        <option value="{{ $id }}" {{ in_array($id, old('questions', [])) ? 'selected' : '' }}>{{ $questions }}</option>
                    @endforeach
                </select>
                @if($errors->has('questions'))
                    <span class="text-danger">{{ $errors->first('questions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.questions_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="anmerkungen">{{ trans('cruds.job.fields.anmerkungen') }}</label>
                <textarea class="form-control {{ $errors->has('anmerkungen') ? 'is-invalid' : '' }}" name="anmerkungen" id="anmerkungen">{{ old('anmerkungen') }}</textarea>
                @if($errors->has('anmerkungen'))
                    <span class="text-danger">{{ $errors->first('anmerkungen') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.anmerkungen_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('milestone_1') ? 'is-invalid' : '' }}">
                    <input class="form-check-input" type="checkbox" name="milestone_1" id="milestone_1" value="1" required {{ old('milestone_1', 0) == 1 || old('milestone_1') === null ? 'checked' : '' }}>
                    <label class="required form-check-label" for="milestone_1">{{ trans('cruds.job.fields.milestone_1') }}</label>
                </div>
                @if($errors->has('milestone_1'))
                    <span class="text-danger">{{ $errors->first('milestone_1') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.milestone_1_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('milestone_2') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="milestone_2" value="0">
                    <input class="form-check-input" type="checkbox" name="milestone_2" id="milestone_2" value="1" {{ old('milestone_2', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="milestone_2">{{ trans('cruds.job.fields.milestone_2') }}</label>
                </div>
                @if($errors->has('milestone_2'))
                    <span class="text-danger">{{ $errors->first('milestone_2') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.milestone_2_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('milestone_3') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="milestone_3" value="0">
                    <input class="form-check-input" type="checkbox" name="milestone_3" id="milestone_3" value="1" {{ old('milestone_3', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="milestone_3">{{ trans('cruds.job.fields.milestone_3') }}</label>
                </div>
                @if($errors->has('milestone_3'))
                    <span class="text-danger">{{ $errors->first('milestone_3') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.milestone_3_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection