<?php

namespace evolunt;


use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $table = 'messages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'content',
        'friend_id'
    ];

    public function user()
    {
        return $this->belongsTo('evolunt\User', 'user_id');
    }

}
