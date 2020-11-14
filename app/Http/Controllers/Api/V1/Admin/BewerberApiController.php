<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Bewerber;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBewerberRequest;
use App\Http\Requests\UpdateBewerberRequest;
use App\Http\Resources\Admin\BewerberResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BewerberApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('bewerber_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BewerberResource(Bewerber::with(['job', 'questions', 'answers', 'team'])->get());
    }

    public function store(StoreBewerberRequest $request)
    {
        $bewerber = Bewerber::create($request->all());
        $bewerber->questions()->sync($request->input('questions', []));
        $bewerber->answers()->sync($request->input('answers', []));

        return (new BewerberResource($bewerber))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Bewerber $bewerber)
    {
        abort_if(Gate::denies('bewerber_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new BewerberResource($bewerber->load(['job', 'questions', 'answers', 'team']));
    }

    public function update(UpdateBewerberRequest $request, Bewerber $bewerber)
    {
        $bewerber->update($request->all());
        $bewerber->questions()->sync($request->input('questions', []));
        $bewerber->answers()->sync($request->input('answers', []));

        return (new BewerberResource($bewerber))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
