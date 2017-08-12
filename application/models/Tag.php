<?php 

use Illuminate\Database\Eloquent\Model;

/**
* Tag
*/
class Tag extends Model
{
	
	protected $fillable = ['name', 'slug'];

	public function products()
	{
		return $this->belongsToMany(Product::class);
	}
}
