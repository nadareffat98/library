<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    public function create()
    {
        return view('notes.create');
    }
    public function store(Request $req)
    {
        //validation
        $req->validate([
            'content'=>'required|string',
        ]);
        Note::create([
            'content'=>$req->content,
            'user_id'=>Auth::user()->id,
        ]);
        return redirect(route('books.index'));
    }
}
