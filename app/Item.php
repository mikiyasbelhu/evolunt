<?php

namespace evolunt;


use Illuminate\Database\Eloquent\Model;

class Item extends Model
{

    protected $table = 'items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'quantity',
        'picture'
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
