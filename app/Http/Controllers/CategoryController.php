<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Jobs\NotificationJob;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::paginate(10)
        ];
        return view('category.index', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required',
            'publish'   => 'required|in:1,2'
        ]);

        Category::create([
            'name'          => $request->name,
            'is_publish'    => $request->publish
        ]);

        return redirect()->route('category.index');
    }

    public function create()
    {
        return view('category.create');
    }

    public function edit($id)
    {
        $data = [
            'category' => Category::find($id)
        ];
        return view('category.edit', $data);
    }

    public function show($id)
    {
        $data = [
            'category' => Category::find($id)
        ];
        return view('category.show', $data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required',
            'publish'   => 'required|in:1,2'
        ]);

        Category::where('id', $id)-> update([
            'name'          => $request->name,
            'is_publish'    => $request->publish
        ]);

        dispatch(new NotificationJob());

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        Category::find($id)->delete();
        dispatch(new NotificationJob());
        return redirect()->route('category.index');
    }

    public function search(Request $request)
    {
    
        $category = Category::where( 'name', 'LIKE', '%' . $request->search . '%' )->paginate (10);
        $category->appends ( array (
            'search' => $request->search
        ) );
        $data = [
            'categories' => $category
        ];
        return view ('category.index', $data);
        
    }
}
