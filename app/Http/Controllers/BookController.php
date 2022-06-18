<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public  function index()
    {
        // $books = Book::get(); == Book::all()
        // $books = Book::select('title','desc')->get(); custom columns
        // $books = Book::where('id','>=',2)->get(); where condition
        // $books = Book::select('title','desc')->where('id','>=',2)->get(); 
        $books = Book::paginate(2);
        return view('books.index',compact('books'));
        
    }

    public function show($id)
    {
        // $book = Book::find($id);
        $book = Book::findOrFail($id);
        return view('books.show',compact('book'));
    }

    //create:function
    public function create()
    {
        return view('books.create');
    }
    
    public function store(Request $req)
    {
        $title= $req->title;
        $desc= $req->desc;
        Book::create([
            'title'=> $title,
            'desc' => $desc
        ]);
        return redirect(route('books.index'));
    }

    //edit:function
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        return view('books.edit',compact('book'));
    }
    public function update(Request $req,$id)
    {
        Book::findOrFail($id)->update([
            'title'=>$req->title,
            'desc'=>$req->desc
        ]);
        return redirect(route('books.show',$id));
    }

    //delete:function
    public function delete($id)
    {
        Book::findOrFail($id)->delete();
        return redirect(route('books.index'));
    }
}
