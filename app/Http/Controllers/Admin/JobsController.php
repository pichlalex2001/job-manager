<?php

namespace App\Http\Controllers\Admin;

use App\Fragen;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Job;
use App\Team;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobsController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $jobs = Job::all();

        $fragens = Fragen::get();

        $teams = Team::get();

        return view('admin.jobs.index', compact('jobs', 'fragens', 'teams'));
    }

    public function create()
    {
        abort_if(Gate::denies('job_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Fragen::all()->pluck('question', 'id');

        return view('admin.jobs.create', compact('questions'));
    }

    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->all());
        $job->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.jobs.index');
    }

    public function edit(Job $job)
    {
        abort_if(Gate::denies('job_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $questions = Fragen::all()->pluck('question', 'id');

        $job->load('questions', 'team');

        return view('admin.jobs.edit', compact('questions', 'job'));
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $job->update($request->all());
        $job->questions()->sync($request->input('questions', []));

        return redirect()->route('admin.jobs.index');
    }

    public function show(Job $job)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $job->load('questions', 'team', 'jobBewerbers');

        return view('admin.jobs.show', compact('job'));
    }
}
