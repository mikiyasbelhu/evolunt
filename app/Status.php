<?php

namespace evolunt;

use Illuminate\Database\Eloquent\Model;


class Status extends Model
{


    protected $table = 'statuses';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'body',
    ];

    public function user()
    {
        return $this->belongsTo('evolunt\User', 'user_id');
    }

    public function scopeNotReply($query)
    {
        return $query->whereNull('parent_id');
    }

    public function replies()
    {
        return $this->hasMany('evolunt\Status','parent_id');
    }

    public function likes()
    {
        return $this->morphMany('evolunt\Like','likeable');
    }

}
