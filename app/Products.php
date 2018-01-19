<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Products extends Model
{
    protected $table = 'products';

	protected $fillable = [
		'id',
		'title',
		'description',
		'created_by',
		'updated_by',
		'created_at',
		'updated_at',
		'deleted_at'
	]; 

	public function relation($data){
		foreach ($data as $dt) {
			$dt->created_by = User::find($dt->created_by);			 
		}
	}



}
