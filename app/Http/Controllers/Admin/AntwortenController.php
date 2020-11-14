<?php

namespace App\Http\Controllers\Admin;

use App\Antworten;
use App\Fragen;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyAntwortenRequest;
use App\Http\Requests\StoreAntwortenRequest;
use App\Http\Requests\UpdateAntwortenRequest;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AntwortenController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('antworten_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $antwortens = Antworten::all();

        $fragens = Fragen::get();

        $teams = Team::get();

        return view('admin.antwortens.index', compact('antwortens', 'fragens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('antworten_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Fragen::all()->pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.antwortens.create', compact('questions'));
    }

    public function store(StoreAntwortenRequest $request)
    {
        $antworten = Antworten::create($request->all());

        return redirect()->route('admin.antwortens.index');
    }

    public function edit(Antworten $antworten)
    {
        abort_if(Gate::denies('antworten_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Fragen::all()->pluck('question', 'id')->prepend(trans('global.pleaseSelect'), '');

        $antworten->load('question', 'team');

        return view('admin.antwortens.edit', compact('questions', 'antworten'));
    }

    public function update(UpdateAntwortenRequest $request, Antworten $antworten)
    {
        $antworten->update($request->all());

        return redirect()->route('admin.antwortens.index');
    }

    public function show(Antworten $antworten)
    {
        abort_if(Gate::denies('antworten_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $antworten->load('question', 'team', 'answersBewerbers');

        return view('admin.antwortens.show', compact('antworten'));
    }

    public function destroy(Antworten $antworten)
    {
        abort_if(Gate::denies('antworten_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $antworten->delete();

        return back();
    }

    public function massDestroy(MassDestroyAntwortenRequest $request)
    {
        Antworten::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
