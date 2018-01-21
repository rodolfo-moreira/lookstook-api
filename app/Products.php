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

	public function created_by(){
		return $this->hasMany( 'App\User', 'id', 'created_by' );
	}

	public function updated_by(){
		return $this->hasMany( 'App\User', 'id', 'updated_by' );
	}


}
