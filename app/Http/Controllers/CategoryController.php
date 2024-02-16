<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
     /**
     * Create the controller instance.
     */
    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
            // 'label' => 'required|unique:categories|string',
            'label' => 'required|string||unique:categories,label,NULL,id,user_id,' . auth()->id(),
           
        ], [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute must be unique.',
            'string' => 'The :attribute must be a string.',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(),422);
        }

        // if (Category::where('label',$request->label)) {
            
        // }
        // $category = Category::firstOrCreate([
        //     'label' => $request->label,
        //     'user_id'=>auth()->user()->id

        // ]);
        $category = Category::create([
           'label'=>$request->label,
           'user_id'=>auth()->user()->id
        ]);
        
     
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
        // return response()->json('hee',200);

    }

   

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'label' => 'unique:categories|string',
           
        ], [
            // 'required' => 'The :attribute field is required.',
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
