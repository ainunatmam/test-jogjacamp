<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryApiController extends Controller
{
    public function index()
    {
        try {
            $category = Category::get();
            return response()->json([
                'status' => 200,
                'message' => 'categories data has been retrieved',
                'data' => $category
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'error occured on retrieving categories data',
                'error' => $e->getMessage()
            ],  500);
        }
    }

    public function show($id) 
    {
        try {
            $data = Category::where('id', $id)->first();
            if (!$data) {
                return response()->json([
                    'status' => 404,
                    'message' => 'error occured on retrieving category data',
                    'error' => $e->getMessage()
                ], 404);
            }

            return response()->json([
                'status' => 200,
                'message' => 'successfully retrieved data',
                'data' => $data
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'error occured on retrieving categories data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'name'          => 'required',
                'publish'       => 'required|in:0,1'            
            ]
        );

        DB::beginTransaction();
        try {
            $category = Category::create([
                'name'            => $request->name,
                'is_publish'      => $request->publish,
            ]);

            if ($category) {
                DB::commit();
                return response()->json([
                    'status'  => 201,
                    'message' => 'category data has been created',
                    'data'    => $category
                ], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'error occured on creating category data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'name'          => 'required',
                'is_publish'    => 'required|in:0,1'            
            ]
        );

        DB::beginTransaction();
        try {
            $category = Category::where('id', $id)->update([
                'name'            => $request->name,
                'is_publish'      => $request->publish,
            ]);
            if ($category) {
                DB::commit();
                return response()->json([
                    'status' => 201,
                    'message' => 'category data has been updated',
                    'data' => $category
                ], 201);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'error occured on updating category data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $category = Category::where('id', $id)->first();
            if (!$category) {
                DB::rollBack();
                return response()->json([
                    'status' => 404,
                    'message' => 'category data not found',
                ], 404);
            }
            $category->delete();
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'category data has been deleted'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => 'error occured on deleting category data',
                'error' => $e->getMessage()
            ], 500);
        }
    } 
}
