<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    protected $table = 'gallery';

    protected $fillable = array('name','description','author');

    public function Photos(){
        return $this->has_many('images');
    }
}
