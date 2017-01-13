<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TopTrack extends Model
{
    //public $table = "toptracks";
    
    protected $fillable = ['id', 'title', 'top'];
    
    //protected $primaryKey = 'toptrack_id';
    
    public function Track() {
        return $this->hasOne(Track::class);
    }
}
