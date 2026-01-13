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
   public function archive()
   {
      return view('ui-archive.archive');
   }
}