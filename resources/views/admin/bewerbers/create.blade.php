@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.bewerber.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.bewerbers.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.bewerber.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bewerber.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email">{{ trans('cruds.bewerber.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bewerber.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="tel">{{ trans('cruds.bewerber.fields.tel') }}</label>
                <input class="form-control {{ $errors->has('tel') ? 'is-invalid' : '' }}" type="text" name="tel" id="tel" value="{{ old('tel', '') }}" required>
                @if($errors->has('tel'))
                    <span class="text-danger">{{ $errors->first('tel') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bewerber.fields.tel_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="job_id">{{ trans('cruds.bewerber.fields.job') }}</label>
                <select class="form-control select2 {{ $errors->has('job') ? 'is-invalid' : '' }}" name="job_id" id="job_id" required>
                    @foreach($jobs as $id => $job)
                        <option value="{{ $id }}" {{ old('job_id') == $id ? 'selected' : '' }}>{{ $job }}</option>
                    @endforeach
                </select>
                @if($errors->has('job'))
                    <span class="text-danger">{{ $errors->first('job') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bewerber.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.bewerber.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Bewerber::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', 'unbekannt') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <span class="text-danger">{{ $errors->first('status') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bewerber.fields.status_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="questions">{{ trans('cruds.bewerber.fields.questions') }}</label>
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
                <span class="help-block">{{ trans('cruds.bewerber.fields.questions_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="answers">{{ trans('cruds.bewerber.fields.answers') }}</label>
                <div style="padding-bottom: 4px">
                    <span class="btn btn-info btn-xs select-all" style="border-radius: 0">{{ trans('global.select_all') }}</span>
                    <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">{{ trans('global.deselect_all') }}</span>
                </div>
                <select class="form-control select2 {{ $errors->has('answers') ? 'is-invalid' : '' }}" name="answers[]" id="answers" multiple>
                    @foreach($answers as $id => $answers)
                        <option value="{{ $id }}" {{ in_array($id, old('answers', [])) ? 'selected' : '' }}>{{ $answers }}</option>
                    @endforeach
                </select>
                @if($errors->has('answers'))
                    <span class="text-danger">{{ $errors->first('answers') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.bewerber.fields.answers_helper') }}</span>
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