<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
     $questions = Question::with('categoryBlog', 'user')->latest()->get();
     return view('page.home',[
        'questions'=>$questions,]);
    }
}

