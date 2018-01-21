<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProductDay;
use App\Products;
use Carbon\Carbon;

class ProductDayController extends Controller
{
    public function productDay(){

    	$productDay = ProductDay::with('id_product.created_by')->first();
    	$now = Carbon::now();

    	if(is_null($productDay)){

    		$productRandom = Products::inRandomOrder()->first();
    		$productSave['id_product'] = $productRandom->id;

    		//return $productSave;
	    	$returnProduct = ProductDay::create($productSave);		
	    	return $returnProduct;

    	}else if($now->toDateString() != $productDay->updated_at->toDateString()){

			$productRandom = Products::where('id', '!=' , $productDay->id_product)->inRandomOrder()->first();
			$productDay['id_product'] = $productRandom->id;

			$productDay->save();
			return $productDay;

		}else{

			return $productDay;
		}   		
    	
    }
}
