<?php

namespace {namespace};

use {modulePath}\Resources\{Model}ListResource;
use {modulePath}\Resources\{Model}ShowResource;
use {modulePath}\Exceptions\{class}Exception;
use {modulePath}\Models\{Model};

class {class}Service
{
    private {Model} ${modelVariable};

    public function __construct({Model} ${modelVariable})
    {
        $this->{modelVariable} = ${modelVariable};
    }

    public function getAll()
    {
        ${routesName} = $this->{modelVariable}->query()
            ->withFilters()
            ->latest('id')
            ->get();

        return {Model}ListResource::collection(${routesName});
    }

    public function getPaginatedList($perPage = 16)
    {
        ${routesName} = $this->{modelVariable}->query()
            ->withFilters()
            ->latest('id')
            ->paginate($perPage);

        return {Model}ListResource::collection(${routesName})
            ->response()
            ->getData(true);
    }

    public function create{Model}($validatedRequest)
    {
        return $this->{modelVariable}->create($validatedRequest);
    }

    public function get{Model}($id)
    {
        ${modelVariable} = $this->{modelVariable}::query()->find($id);

        if (!${modelVariable}) {
            throw {class}Exception::notFound();
        }
        return {Model}ShowResource::make(${modelVariable});
    }

    public function update{Model}($validatedRequest, $id)
    {
        ${modelVariable} = $this->get{Model}($id);
        ${modelVariable}->update($validatedRequest);
       
        return {Model}ShowResource::make(${modelVariable});
    }

    public function delete{Model}($id)
    {
        return $this->{modelVariable}->where('id', $id)->delete();
    }
}
