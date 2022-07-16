<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ApiBookController extends Controller
{
    public function index()
    {
        $books = Book::get();
        return response()->json($books);
    }

    public function show($id)
    {
        $book = Book::with('categories')->findOrFail($id);
        return response()->json($book);
    }

    public function store(Request $req)
    {
        //validation
        $req->validate([
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:jpg,png',
            'category_ids'=>'required',
            //check if value exists in id column in categories table
            'category_ids.*'=>'exists:categories,id'
        ]);
        $img = $req->file('img');
        $extension = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . ".$extension";
        $img->move(public_path('uploads/books'),$name);
        $book= Book::create([
            'title'=>  $req->title,
            'desc' =>  $req->desc,
            'img'=> $name
        ]);
        $book->categories()->sync($req->category_ids);
        return response()->json('Book Created Successfully');
    }

    public function update(Request $req,$id)
    {
        //validation
        $validator = validator::make($req->all(),[
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'nullable|image|mimes:jpg,png',
            'category_ids'=>'required',
            'category_ids.*'=>'exists:categories,id'
        ]);
        if($validator->fails())
        {
            $errors = $validator->errors();
            return response()->json($errors);
        };
        $book = Book::findOrFail($id) ;
        $name = $book->img;
        if($req->hasFile('img'))
        {
            if($name)
            {
                unlink(public_path('uploads/books/').$name);
            }
            $img = $req->file('img');
            $extension = $img->getClientOriginalExtension();
            $name = "book-" . uniqid() . ".$extension";
            $img->move(public_path('uploads/books'),$name);
        }

        $book->update([
            'title'=>$req->title,
            'desc'=>$req->desc,
            'img'=>$name
        ]);
        $book->categories()->sync($req->category_ids);
        return response()->json('Book Updated Successfully');
    }

    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if($book->img)
        {
            unlink(public_path('uploads/books/').$book->img);
        }
        //delete book from book_category table first 
        $book->categories()->sync([]);
        $book->delete();
        return response()->json('Book Deleted Successfully');
    }

}
