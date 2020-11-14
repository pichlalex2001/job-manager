<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Fragen;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFragenRequest;
use App\Http\Requests\UpdateFragenRequest;
use App\Http\Resources\Admin\FragenResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FragenApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('fragen_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FragenResource(Fragen::with(['team'])->get());
    }

    public function store(StoreFragenRequest $request)
    {
        $fragen = Fragen::create($request->all());

        return (new FragenResource($fragen))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Fragen $fragen)
    {
        abort_if(Gate::denies('fragen_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new FragenResource($fragen->load(['team']));
    }

    public function update(UpdateFragenRequest $request, Fragen $fragen)
    {
        $fragen->update($request->all());

        return (new FragenResource($fragen))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Fragen $fragen)
    {
        abort_if(Gate::denies('fragen_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fragen->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
