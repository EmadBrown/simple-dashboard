<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'title',
        'body',
        'cover_image'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
