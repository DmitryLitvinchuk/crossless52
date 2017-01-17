<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WrongTracks extends Model
{
     protected $fillable = ['id', 'title', 'user_id', 'top_track_id'];
     
     public function Track() {
        return $this->belongsTo(Track::class);
    }
}
