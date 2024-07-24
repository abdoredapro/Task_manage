<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'slug',
    ];


    protected static function booted() {
        static::creating(function (Category $category) {
            $category->slug = Str::slug($category->name);
        });

        static::addGlobalScope('auth_user', function(Builder $builder) {
            $builder->where('user_id', Auth::id());
        });
    }
}
