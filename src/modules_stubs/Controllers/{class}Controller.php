<?php

namespace {namespace};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use {modulePath}\Requests\Store{Model}Request;
use {modulePath}\Requests\Update{Model}Request;
use {modulePath}\Services\{Model}Service;

class {class}Controller extends Controller
{
    private ${modelVariable}Service;

    public function __construct({Model}Service ${modelVariable}Service)
    {
        $this->{modelVariable}Service = ${modelVariable}Service;
    }

    public function getAll(Request $request)
    {
   
       ${routesName} = $this->{modelVariable}Service->getAll();

        return response()->json([
            '{routesName}' => ${routesName},
        ]);
    }

    public function getPaginatedList(Request $request)
    {
   
       ${routesName} = $this->{modelVariable}Service->getPaginatedList();

        return ${routesName}
    }
 
    public function store{Model}(Store{Model}Request $request)
    {

        $validatedRequest = $request->validated();

        $this->{modelVariable}Service->create{Model}($validatedRequest);

        return response()->json([
            'message' => '{modelVariable} has been created successfully',
        ]);
    }

    public function show{Model}($id)
    {
       
        ${modelVariable} = $this->{modelVariable}Service->show{Model}($id);

        return response()->json([
            '{modelVariable}' => ${modelVariable},
        ]);
    }

    public function update{Model}(Update{Model}Request $request, $id)
    {
      
        $validatedRequest = $request->validated();

        ${modelVariable} = $this->{modelVariable}Service->update{Model}($validatedRequest, $id);

        return response()->json([
            'message' => '{modelVariable} has been updated successfully',
           '{modelVariable}' => ${modelVariable},
        ]);
    }

    public function destroy{Model}($id)
    { 

        $this->{modelVariable}Service->delete{Model}($id);

        return response()->json([
            'message' => '{modelVariable} has been deleted successfully',
        ]);
    }
}
