<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //read
    public function index()
    {
        $categories = Category::paginate(3);
        return view('categories.index',compact('categories'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show',compact('category'));
    }

    //create:function
    public function create()
    {
        return view('categories.create');
    }
    
    public function store(Request $req)
    {
        //validation
        $req->validate([
            'name'=>'required|string|max:100',
        ]);
        Category::create([
            'name'=> $req->name
        ]);
        return redirect(route('categories.index'));
    }

    //edit:function
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit',compact('category'));
    }
    public function update(Request $req,$id)
    {
        //validation
        $req->validate([
            'name'=>'required|string|max:100',
        ]);
        $category = Category::findOrFail($id) ;
        $category->update([
            'name'=>$req->name,
        ]);
        return redirect(route('categories.show',$id));
    }

    //delete:function
    public function delete($id)
    {
        Category::findOrFail($id)->delete();
        return redirect(route('categories.index'));
    }

}
