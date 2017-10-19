<?php

namespace evolunt;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Notifications\Notification;

class User extends Model implements AuthenticatableContract,CanResetPasswordContract
{
    use Authenticatable,CanResetPassword,Notifiable;


    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'picture',
        'first_name',
        'last_name',
        'location',
        'admin',
        'charity',
        'name',
        'description'
    ];

    /**
     *  The attributes that should be casted to native types.
     *
     *  @var array
     */
    protected $casts = [
        'settings' => 'array'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function statuses()
    {
        return $this->hasMany('evolunt\Status','user_id');
    }

    public function events()
    {
        return $this->hasMany('evolunt\Event','user_id');
    }

    public function items()
    {
        return $this->hasMany('evolunt\Item','user_id');
    }

    public function funds()
    {
        return $this->hasMany('evolunt\Fund','user_id');
    }

    public function messages()
    {
        return $this->hasMany('evolunt\Message','user_id');
    }

    public function notifications()
    {
        return $this->hasMany('evolunt\Notification','user_id');
    }

    public function getName()
    {
        if($this->name)
        {
            return $this->name;
        }

        if($this->first_name && $this->last_name){
            return "{$this->first_name} {$this->last_name}";
        }
        if($this->first_name)
        {
            return $this->first_name;
        }

        return null;
    }

    public function getNameOrUserName()
    {
        return $this->getName()  ?: $this->username;
    }

    public function getFirstNameOrUsername()
    {
        return $this->first_name ?: $this->username;
    }

    public function iFollow()
    {
        return $this->belongsToMany('evolunt\User','follows','user_id', 'friend_id')->get();

    }

    public function whoFollowsMe()
    {
        return $this->belongsToMany('evolunt\User','follows','friend_id','user_id')->get();
    }

    public function isFollowing(User $user)
    {
        return (bool) $this->belongsToMany('evolunt\User','follows','user_id', 'friend_id')->wherePivot('friend_id',$user->id)->count();
    }

    public function isFollowedBy(User $user)
    {
        return (bool) $this->belongsToMany('evolunt\User','follows','user_id', 'friend_id')->where('id',$user->id)
            ->count();

    }

    public function likes()
    {
        return $this->hasMany('evolunt\Like','user_id');
    }

    public function hasLikedStatus(Status $status)
    {
        return (bool) $status->likes
            ->where('likeable_id',$status->id)
            ->where('likeable_type', get_class($status))
            ->where('user_id',$this->id)
            ->count();
    }

    public function Follow(User $user)
    {
        $this->belongsToMany('evolunt\User','follows','user_id','friend_id')->attach($user->id);
    }

    public function Unfollow(User $user)
    {
        $this->belongsToMany('evolunt\User','follows','user_id','friend_id')->detach($user->id);
    }

    public function getUser($id)
    {
        return User::where('id',$id);
    }

    public function getItem($id)
    {
        return Item::where('id',$id);
    }

    public function getFund($id)
    {
        return Fund::where('id',$id);
    }

    public function hasAsked(Item $item)
    {
        return (bool) $item->notifications
            ->where('user_id',$this->id)
            ->where('notifiable_id', $item->id)
            ->count();
    }

    public function hasSupported(Fund $fund)
    {
        return (bool) $fund->notifications
            ->where('user_id',$this->id)
            ->where('notifiable_id', $fund->id)
            ->count();
    }
}
