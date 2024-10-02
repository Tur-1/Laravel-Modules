<?php

namespace {pageNamespace};

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use {pagePath}\Requests\{class}Request;
use {pagePath}\Requests\{class}Request;
use {pagePath}\Services\{class}Service;

class {class}Controller extends Controller
{
    
    public function getAll(Request $request)
    {
   
       return;
    }
 
    public function getPaginatedList(Request $request)
    {
   
        return;
    }
    public function store({class}Request $request)
    {

        $validatedRequest = $request->validated();

        return response()->json([
            'message' => 'has been created successfully',
        ]);
    }

    public function show($id)
    {
       
        return;
    }

    public function update({class}Request $request, $id)
    {
      
        $validatedRequest = $request->validated();

        return response()->json([
            'message' => 'has been updated successfully',,
        ]);
    }

    public function destroy($id)
    { 


        return response()->json([
            'message' => 'has been deleted successfully',
        ]);
    }
}
