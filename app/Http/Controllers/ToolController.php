<?php

namespace App\Http\Controllers;

use App\Models\Tool;
use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ToolController extends Controller
{
    /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Tool::class, 'tool');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $toolsWithCategory=Tool::with('category')->where('user_id',auth()->user()->id)->get();
        // dd($toolsWithCategory->toArray());
        return response()->json($toolsWithCategory,200
    );

    }

  

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // 'label' => 'required|unique:categories|string',
            'label' => 'required|string|unique:tools,label,NULL,id,user_id,' . auth()->id(),
            'category_id'=>'nullable|exists:categories,id'
           
        ], [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute must be unique.',
            'string' => 'The :attribute must be a string.',
            'exists'=>'The category doesnt exists'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $tool=Tool::create([
            'label'=>$request->label,
            'category_id'=>$request->has('category_id') ? $request->category_id :null,
            'user_id'=>auth()->user()->id
        ]);
        return response()->json([
            'message' => 'Tool created seccufully',
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        return response()->json($tool,200);

    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tool $tool)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'string|unique:tools,label,NULL,id,user_id,' . auth()->id(),
            'category_id'=>'exists:categories,id'           
        ], [
            'unique' => 'The :attribute must be unique.',
            'string' => 'The :attribute must be a string.',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
       $tool->update($request->all());
      return response()->json([
        'message'=>'updated secc',

      ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        Tool::destroy($tool->id);
        return response()->json([
            'message'=>'deleted secc'
          ],200);
    }
}
