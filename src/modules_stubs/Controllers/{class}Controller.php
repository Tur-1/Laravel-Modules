<?php

namespace {namespace};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use {modulePath}\Requests\Store{Model}Request;
use {modulePath}\Requests\Update{Model}Request;
use {modulePath}\Services\{Model}Service;
use {modulePath}\Models\{Model};
use Illuminate\Support\Facades\Gate;

class {class}Controller extends Controller
{
    private ${modelVariable}Service;

    public function __construct({Model}Service ${modelVariable}Service)
    {
        $this->{modelVariable}Service = ${modelVariable}Service;
    }

    public function getAll(Request $request)
    {
   
        Gate::authorize('viewAny', {Model}::class);

       ${routesName} = $this->{modelVariable}Service->getAll();

        return response()->json([
            '{routesName}' => ${routesName},
        ]);
    }

    public function getPaginatedList(Request $request)
    {
   
        Gate::authorize('viewAny', {Model}::class);

       ${routesName} = $this->{modelVariable}Service->getPaginatedList();

        return ${routesName};
    }
 
    public function store(Store{Model}Request $request)
    {

        Gate::authorize('create', {Model}::class);

        $validatedRequest = $request->validated();

        $this->{modelVariable}Service->create{Model}($validatedRequest);

        return response()->json([
            'message' => '{modelVariable} has been created successfully',
        ]);
    }

    public function show($id)
    {
       
        Gate::authorize('view', {Model}::class);

        ${modelVariable} = $this->{modelVariable}Service->get{Model}($id);

        return response()->json([
            '{modelVariable}' => ${modelVariable},
        ]);
    }

    public function update(Update{Model}Request $request, $id)
    {
      
        Gate::authorize('update', {Model}::class);

        $validatedRequest = $request->validated();

        ${modelVariable} = $this->{modelVariable}Service->update{Model}($validatedRequest, $id);

        return response()->json([
            'message' => '{modelVariable} has been updated successfully',
           '{modelVariable}' => ${modelVariable},
        ]);
    }

    public function destroy($id)
    { 

        Gate::authorize('delete', {Model}::class);

        $this->{modelVariable}Service->delete{Model}($id);

        return response()->json([
            'message' => '{modelVariable} has been deleted successfully',
        ]);
    }
}
