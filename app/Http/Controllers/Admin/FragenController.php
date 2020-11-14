<?php

namespace App\Http\Controllers\Admin;

use App\Fragen;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyFragenRequest;
use App\Http\Requests\StoreFragenRequest;
use App\Http\Requests\UpdateFragenRequest;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FragenController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('fragen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fragens = Fragen::all();

        $teams = Team::get();

        return view('admin.fragens.index', compact('fragens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('fragen_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fragens.create');
    }

    public function store(StoreFragenRequest $request)
    {
        $fragen = Fragen::create($request->all());

        return redirect()->route('admin.fragens.index');
    }

    public function edit(Fragen $fragen)
    {
        abort_if(Gate::denies('fragen_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fragen->load('team');

        return view('admin.fragens.edit', compact('fragen'));
    }

    public function update(UpdateFragenRequest $request, Fragen $fragen)
    {
        $fragen->update($request->all());

        return redirect()->route('admin.fragens.index');
    }

    public function show(Fragen $fragen)
    {
        abort_if(Gate::denies('fragen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fragen->load('team', 'questionAntwortens', 'questionsJobs', 'questionsBewerbers');

        return view('admin.fragens.show', compact('fragen'));
    }

    public function destroy(Fragen $fragen)
    {
        abort_if(Gate::denies('fragen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fragen->delete();

        return back();
    }

    public function massDestroy(MassDestroyFragenRequest $request)
    {
        Fragen::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
