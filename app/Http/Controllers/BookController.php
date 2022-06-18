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
        //validation
        $req->validate([
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'required|image|mimes:jpg,png'
        ]);
        $img = $req->file('img');
        $extension = $img->getClientOriginalExtension();
        $name = "book-" . uniqid() . ".$extension";
        $img->move(public_path('uploads/books'),$name);
        $title= $req->title;
        $desc= $req->desc;
        Book::create([
            'title'=> $title,
            'desc' => $desc,
            'img'=> $name
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
        //validation
        $req->validate([
            'title'=>'required|string|max:100',
            'desc'=>'required|string',
            'img'=>'nullable|image|mimes:jpg,png'
        ]);
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
        return redirect(route('books.show',$id));
    }

    //delete:function
    public function delete($id)
    {
        $book = Book::findOrFail($id);
        if($book->img)
        {
            unlink(public_path('uploads/books/').$book->img);
        }
        $book->delete();
        return redirect(route('books.index'));
    }
}
