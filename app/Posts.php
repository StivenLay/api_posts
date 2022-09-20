<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    public $timestamps = false;

    protected $table = 'posts';
    protected $fillable = ['Title', 'Content', 'Category', 'Status'];
    protected $hidden = ['Id', 'Created_date', 'Updated_date'];

}
