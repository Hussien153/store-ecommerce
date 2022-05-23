<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Cart;

class CategoriesController extends Controller
{
    public function index()
    {
        
        $products = Product::select('id','title_'.app() -> getLocale() .' as title')->get();
        return response()->json($products);
    //    return response()->json([
     //       'products'=> $products,
     //       'status'=>true,
     //       'message'=>'success'
   //     ]);
        // return view('products.index',compact('products'));
    }
}
