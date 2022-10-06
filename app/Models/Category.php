<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use TypiCMS\NestableTrait;
class Category extends Model
{
    use NestableTrait;
    
    protected $table = 'categories';

    protected $fillable = [
        'name', 'slug', 'description', 'parent_id', 'featured', 'menu', 'image'
    ];

    protected $casts = [
        'parent_id' =>  'integer',
        'featured'  =>  'boolean',
        'menu'      =>  'boolean'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $slugName = $this->uniqueSlug($value);
        $slug = $this->attributes['slug'] = $slugName;
    }

    public function uniqueSlug($name) {
        $slug = str::slug($name, '-');
        $count = Category::where('slug', 'Like', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';

        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_categories', 'category_id', 'product_id');
    }
}
