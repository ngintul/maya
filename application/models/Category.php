<?php 

use Illuminate\Database\Eloquent\Model;

/**
* Category
*/
class Category extends Model
{
	
	protected $fillable = ['name', 'slug'];

	public function products()
	{
		return $this->hasMany(Product::class);
	}
}
