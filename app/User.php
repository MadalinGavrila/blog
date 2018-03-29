<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'username',
                'onUpdate' => true
            ]
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role_id', 'photo_id', 'is_active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $uploads = '/images/';

    public function photoPlaceholder() {
        return $this->uploads . "placeholder_user.jpg";
    }

    public function checkRole($role1, $role2 = '') {
        if(!empty($role2)) {
            if($this->role->name == $role1 || $this->role->name == $role2) {
                if($this->isActive()) {
                    return true;
                }
            }
        } else if($this->role->name == $role1 && $this->isActive()) {
            return true;
        }

        return false;
    }

    public function isActive() {
        if($this->is_active) {
            return true;
        }

        return false;
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function photo()
    {
        return $this->belongsTo('App\Photo');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function postComments()
    {
        return $this->hasManyThrough('App\Comment', 'App\Post', 'user_id', 'post_id');
    }

}
