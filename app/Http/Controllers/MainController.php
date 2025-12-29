<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Note;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        //load user's notes
        $id = session('user.id');
        $user = User::find($id)->toArray();
        $notes = User::find($id)->notes()->get()->toArray();


        //show home view
        return view('home',['notes'=>$notes]);
    }
    public function newNote(){
        echo" i'm created a new note";
    }

}