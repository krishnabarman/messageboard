<?php

namespace App\Http\Controllers;

use App\Category;
use App\Domain;
use App\Message;
use App\Subcategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         //show 5 recent messages
         $messages = Message::with('user')->orderBy('created_at','desc')->take(5)->get();

         $categories = Category::get();
         $subcategories = Subcategory::get();
         $domains = Domain::get();
    
         return view("pages.home",[
             'messages' => $messages,
             'domains' => $domains,
             'categories' => $categories,
             'subcategories' =>$subcategories
         ]);
        
    }
}
