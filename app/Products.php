<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

	protected $fillable = [
		'id',
		'title',
		'description',
		'created_by',
		'updated_by',
		'id_login',
		'created_at',
		'updated_at',
		'deleted_at'
	]; 
}
