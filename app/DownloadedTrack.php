<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadedTrack extends Model
{
    protected $fillable = ['title', 'user_id', 'track_id', 'title', 'artist'];
    
    
}
