<?php

namespace evolunt;


use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $table = 'events';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'date'
    ];

    public function user()
    {
        return $this->belongsTo('evolunt\User', 'user_id');
    }

    public function likes()
    {
        return $this->morphMany('evolunt\Like','likeable');
    }
}
