<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        echo " i'm inside the app";
    }
    public function newNote(){
        echo" i'm created a new note";
    }

}