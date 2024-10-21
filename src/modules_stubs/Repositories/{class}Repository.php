<?php

namespace {namespace};

use {modulePath}\Models\{Model};

class {class}Repository
{
    private {Model} ${modelVariable};

    public function __construct({Model} ${modelVariable})
    {
        $this->{modelVariable} = ${modelVariable};
    }
    public function getAll()
    {
        return $this->{modelVariable}->query()
        ->withFilters()
        ->latest('id')
        ->get();
    }
    public function getPaginatedList($records = 16)
    {
        return $this->{modelVariable}->query()
        ->withFilters()
        ->latest('id')
        ->paginate($records);
    }
    public function create{Model}($validatedRequest)
    {
        return $this->{modelVariable}->create($validatedRequest);
    }
    public function get{Model}($id)
    {
        $this->{modelVariable} = $this->{modelVariable}::query()->findOrFail($id);
        
        return $this->{modelVariable};
    }
    public function update{Model}($validatedRequest, $id)
    {
        ${modelVariable} = $this->get{Model}($id);
        ${modelVariable}->update($validatedRequest);
        return  ${modelVariable};
    }
    public function delete{Model}($id)
    {
        return $this->{modelVariable}->where('id', $id)->delete();
    }
}