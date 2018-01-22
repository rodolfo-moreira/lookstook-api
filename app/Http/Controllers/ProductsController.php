<?php

namespace App\Http\Controllers;

use App\Products;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{

    public function index(){ 

    	$products = Products::with('created_by')->with('updated_by')->get();
        return response()->json($products, 200);
    }


    public function show($id){
    	$product = Products::with('created_by')->with('updated_by')->find($id);
        return response()->json($products, 200);
    }

    public function store(Request $request){
    	$product = $request->all();
    	$user = Auth::user();
    	$product['created_by'] = $user->id;
    	$product['updated_by'] = $user->id;
    	$returnProduct = Products::create($product);

        return response()->json($returnProduct, 201);
    }

    public function update($id, Request $request){

    	$product = Products::find($id);
    	$user = Auth::user();

    	if($product->created_by == $user->id){

    		$product['title'] = $request->description;
    		$product['description'] = $request->description;    	
	    	$product['created_by'] = $user->id;
	    	$product['updated_by'] = $user->id;

            $returnProduct = $product->save();
            return response()->json($returnProduct, 200);

    	}else{
    		
            $response = array('message' => 'Você precica ter criado o produto para edita-lo');
            return response()->json($response, 401);
    	}

    	

    }

    public function delete($id){
    	$product = Products::find($id);
    	$user = Auth::user();

    	if($product->created_by == $user->id){

	    	$product = Products::find($id);
			$product->delete();

            $response = array('message' => 'Deletado com sucesso!');
            return response()->json($response, 204);

		}else{
    	
            $response = array('message' => 'Você precica ter criado o produto para exclui-lo');
            return response()->json($response, 401);
    	}
    }

    public function last(){

    	$product = Products::orderBy('created_at', 'desc')->first();
        return response()->json($product, 200);
    }


}
