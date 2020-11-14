<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Antworten;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAntwortenRequest;
use App\Http\Requests\UpdateAntwortenRequest;
use App\Http\Resources\Admin\AntwortenResource;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AntwortenApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('antworten_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AntwortenResource(Antworten::with(['question', 'team'])->get());
    }

    public function store(StoreAntwortenRequest $request)
    {
        $antworten = Antworten::create($request->all());

        return (new AntwortenResource($antworten))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Antworten $antworten)
    {
        abort_if(Gate::denies('antworten_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new AntwortenResource($antworten->load(['question', 'team']));
    }

    public function update(UpdateAntwortenRequest $request, Antworten $antworten)
    {
        $antworten->update($request->all());

        return (new AntwortenResource($antworten))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Antworten $antworten)
    {
        abort_if(Gate::denies('antworten_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $antworten->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
