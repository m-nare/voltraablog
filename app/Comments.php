<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    //Table Name
	protected $table = 'comments';
    
    //Primary Key
	public $primaryKey = 'id';
    
    //Timestamps
    public $timestamps = true;
    
    public function post(){
        return $this->belongsTo('App\Post');
    }
}
