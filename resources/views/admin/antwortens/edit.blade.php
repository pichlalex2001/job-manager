@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.antworten.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.antwortens.update", [$antworten->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="question_id">{{ trans('cruds.antworten.fields.question') }}</label>
                <select class="form-control select2 {{ $errors->has('question') ? 'is-invalid' : '' }}" name="question_id" id="question_id" required>
                    @foreach($questions as $id => $question)
                        <option value="{{ $id }}" {{ (old('question_id') ? old('question_id') : $antworten->question->id ?? '') == $id ? 'selected' : '' }}>{{ $question }}</option>
                    @endforeach
                </select>
                @if($errors->has('question'))
                    <span class="text-danger">{{ $errors->first('question') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.antworten.fields.question_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="answer">{{ trans('cruds.antworten.fields.answer') }}</label>
                <input class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" type="text" name="answer" id="answer" value="{{ old('answer', $antworten->answer) }}" required>
                @if($errors->has('answer'))
                    <span class="text-danger">{{ $errors->first('answer') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.antworten.fields.answer_helper') }}</span>
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