<?php

namespace App\Http\Controllers;

use App\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    public function index(){

    	$products = Products::all();
    	return $products;
    }

    public function show($id){
    	$product = Products::find($id);
    	return $product;
    }

    public function store(Request $request){
    	$product = $request->all();
    	$user = Auth::user();
    	$product['created_by'] = $user->id;
    	$product['updated_by'] = $user->id;
    	Products::create($product);
    }

    public function update($id, Request $request){

    	$product = Products::find($id);
    	$user = Auth::user();

    	if($product->created_by == $user->id){

    		$product['title'] = $request->description;
    		$product['description'] = $request->description;    	
	    	$product['created_by'] = $user->id;
	    	$product['updated_by'] = $user->id;

	    	$product->save();

    	}else{
    		return "Precisa ter o mesmo id de usuario";
    	}

    	

    }

    public function delete($id){
    	$product = Products::find($id);
    	$user = Auth::user();

    	if($product->created_by == $user->id){

	    	$product = Products::find($id);
			$product->delete();

		}else{
    		return "Precisa ter o mesmo id de usuario";
    	}
    }


}
