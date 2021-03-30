<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'slug',
        'img_path'
    ];
    public function users() {
        return $this->belongsToMany('App\User');
    }
}
