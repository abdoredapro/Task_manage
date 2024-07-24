<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id','category_id', 'title', 'description', 'status'
    ];


    public function category() {
        return $this->belongsTo(Category::class);
    }

    /**
     * User Has Tasks
     */
    public function user() {
        return $this->belongsTo(User::class);
    }


    protected static function booted()
    {
        static::addGlobalScope('auth_user', function(Builder $builder) {
            $builder->where('user_id', Auth::id());
        });
    }

    
}
