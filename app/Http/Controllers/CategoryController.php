<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id=auth()->user()->id;

        // $userToolCategories=User::find($id)->with('categories')->get();
        $userToolCategories=auth()->user()->categories;
        return response()->json($userToolCategories,200

        );
    }

 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|unique:categories|string',
           
        ], [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute must be unique.',
            'string' => 'The :attribute must be a string.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
        $category = Category::create([
           'label'=>$request->label,
        ]);
        
        // $category->users()->attach(auth()->user()->id);
        auth()->user()->categories()->attach($category);
        return response()->json([
            'message' => 'CategoryTool created seccufully',
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category,200);

    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'required|unique:categories|string',
           
        ], [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute must be unique.',
            'string' => 'The :attribute must be a string.',
        ]);


        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }
       $category->update($request->all());
      return response()->json([
        'message'=>'updated secc',

      ],200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return response()->json([
            'message'=>'deleted secc'
          ],200);
    }
}
