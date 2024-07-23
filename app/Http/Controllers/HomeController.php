<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $bookCount = DB::table('books')->where('is_deleted', 0)->count();
        $categoryCount = DB::table('categorys')->where('is_deleted', 0)->count();
        
        return view('home', compact('bookCount', 'categoryCount'));
    }
}