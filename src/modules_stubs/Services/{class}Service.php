<?php

namespace {pageNamespace};

use {modulePath}\Repositories\{Model}Repository;
use {modulePath}\Resources\{Model}ListResource;
use {modulePath}\Resources\{Model}ShowResource;

class {class}Service
{
    private ${modelVariable}Repository;

    public function __construct({Model}Repository ${modelVariable}Repository)
    {
        $this->{modelVariable}Repository = ${modelVariable}Repository;
    }

    public function getAll()
    {
        return {Model}ListResource::collection($this->{modelVariable}Repository->getAll());
    }
    public function getPaginatedList($records = 15)
    {
        return {Model}ListResource::collection($this->{modelVariable}Repository->getPaginatedList($records))
        ->response()
        ->getData(true);
    }

    public function create{Model}($validatedRequest)
    {
        return $this->{modelVariable}Repository->create{Model}($validatedRequest);
    }

    public function show{Model}($id)
    {
        return {Model}ShowResource::make($this->{modelVariable}Repository->get{Model}($id));
    }

    public function update{Model}($validatedRequest, $id)
    {
        ${modelVariable} = $this->{modelVariable}Repository->update{Model}($validatedRequest, $id);

        return {Model}ShowResource::make(${modelVariable});
    }

    public function delete{Model}($id)
    {
        return $this->{modelVariable}Repository->delete{Model}($id);
    }
}
