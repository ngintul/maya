<?php 

use Illuminate\Database\Eloquent\Model;

/**
* Product
*/
class Product extends Model
{
	
	protected $fillable = ['title', 'slug', 'image', 'detail', 'cat_id'];

	public function category()
	{
		return $this->belongsTo(Category::class, 'cat_id');
	}

    public function tags()
    {
    	return $this->belongsToMany(Tag::class);
    }
}
