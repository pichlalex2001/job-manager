<?php

namespace App\Http\Controllers\Admin;

use App\Antworten;
use App\Bewerber;
use App\Fragen;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\StoreBewerberRequest;
use App\Http\Requests\UpdateBewerberRequest;
use App\Job;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BewerberController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('bewerber_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bewerbers = Bewerber::all();

        $jobs = Job::get();

        $fragens = Fragen::get();

        $antwortens = Antworten::get();

        $teams = Team::get();

        return view('admin.bewerbers.index', compact('bewerbers', 'jobs', 'fragens', 'antwortens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('bewerber_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::all()->pluck('job_nr', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Fragen::all()->pluck('question', 'id');

        $answers = Antworten::all()->pluck('answer', 'id');

        return view('admin.bewerbers.create', compact('jobs', 'questions', 'answers'));
    }

    public function store(StoreBewerberRequest $request)
    {
        $bewerber = Bewerber::create($request->all());
        $bewerber->questions()->sync($request->input('questions', []));
        $bewerber->answers()->sync($request->input('answers', []));

        return redirect()->route('admin.bewerbers.index');
    }

    public function edit(Bewerber $bewerber)
    {
        abort_if(Gate::denies('bewerber_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::all()->pluck('job_nr', 'id')->prepend(trans('global.pleaseSelect'), '');

        $questions = Fragen::all()->pluck('question', 'id');

        $answers = Antworten::all()->pluck('answer', 'id');

        $bewerber->load('job', 'questions', 'answers', 'team');

        return view('admin.bewerbers.edit', compact('jobs', 'questions', 'answers', 'bewerber'));
    }

    public function update(UpdateBewerberRequest $request, Bewerber $bewerber)
    {
        $bewerber->update($request->all());
        $bewerber->questions()->sync($request->input('questions', []));
        $bewerber->answers()->sync($request->input('answers', []));

        return redirect()->route('admin.bewerbers.index');
    }

    public function show(Bewerber $bewerber)
    {
        abort_if(Gate::denies('bewerber_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $bewerber->load('job', 'questions', 'answers', 'team');

        return view('admin.bewerbers.show', compact('bewerber'));
    }
}
