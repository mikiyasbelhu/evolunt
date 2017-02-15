<?php

namespace evolunt;


use Illuminate\Database\Eloquent\Model;

class Fund extends Model
{

    protected $table = 'funds';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'cause',
        'description',
        'amount'
    ];

    public function user()
    {
        return $this->belongsTo('evolunt\User', 'user_id');
    }

    public function likes()
    {
        return $this->morphMany('evolunt\Like','likeable');
    }

    public function notifications()
    {
        return $this->morphMany('evolunt\Notification','notifiable');
    }
}
