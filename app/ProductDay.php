<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductDay extends Model
{
    protected $table = 'product_day';

	protected $fillable = [
		'id',
		'id_product',
		'created_at',
		'updated_at',
		'deleted_at'
	]; 
}
