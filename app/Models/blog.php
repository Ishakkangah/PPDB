<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug', 
        'post', 
        'post_excerpt', 
        'user_id',
        'metaDescription',
        'jsonData'    
    ];

    public function setSlugAttribute($title){
        $this->attributes['slug'] =  $this->uniqueSlug($title);
    }

    private function uniqueSlug($title){
        $slug = Str::slug($title, '-');
        $count = Blog::where('slug', 'LIKE', "{$slug}%")->count();
        $newCount = $count > 0 ? ++$count : '';
        return $newCount > 0 ? "$slug-$newCount" : $slug;
    }

    // setiap blog memiliki banyak tag
    public function tags(){
        return $this->belongsToMany(tag::class);
    }

    // setiap blog memiliki banyak kategori
    public function categoris(){
        return $this->belongsToMany(categori::class);
    }

}
