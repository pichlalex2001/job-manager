@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.fragen.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.fragens.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="question">{{ trans('cruds.fragen.fields.question') }}</label>
                <input class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question" id="question" value="{{ old('question', '') }}" required>
                @if($errors->has('question'))
                    <span class="text-danger">{{ $errors->first('question') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.fragen.fields.question_helper') }}</span>
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