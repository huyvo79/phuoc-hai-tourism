<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Http\Requests\CartRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;


class IndexController extends Controller
{
   public function index()
   {
      return view('ui-index.index');
   }
   public function single()
   {
      return view('ui-single.single');
   }
   public function contact()
   {
      return view('pages.contact');
   }
   public function news()
   {
     // $posts = Post::orderBy('created_at', 'desc')->paginate(5);
      return view('pages.news');
   }
   public function events()
   {
      return view('pages.events');
   }
   public function plan()
   {
      return view('pages.plan');
   }
   public function explore()
   {
      return view('pages.explore');
   }
   public function post_details()
   {
      return view('pages.posts_details');
   }
   public function archive()
   {
      return view('ui-archive.archive');
   }
}