<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreJobRequest;
use App\Http\Requests\UpdateJobRequest;
use App\Http\Resources\Admin\JobResource;
use App\Job;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class JobsApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('job_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobResource(Job::with(['questions', 'team'])->get());
    }

    public function store(StoreJobRequest $request)
    {
        $job = Job::create($request->all());
        $job->questions()->sync($request->input('questions', []));

        return (new JobResource($job))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Job $job)
    {
        abort_if(Gate::denies('job_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new JobResource($job->load(['questions', 'team']));
    }

    public function update(UpdateJobRequest $request, Job $job)
    {
        $job->update($request->all());
        $job->questions()->sync($request->input('questions', []));

        return (new JobResource($job))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
