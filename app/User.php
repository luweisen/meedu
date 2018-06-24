<?php

namespace App;

use App\Models\Course;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const ACTIVE_YES = 1;
    const ACTIVE_NO = -1;

    const LOCK_YES = 1;
    const LOCK_NO = -1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'nick_name', 'mobile', 'password',
        'is_lock', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = [
        'show_url', 'credit1_text', 'credit2_text', 'credit3_text',
    ];

    /**
     * 获取随机呢称
     * @return string
     */
    public static function randomNickName()
    {
        return 'random.' . str_random(10);
    }

    /**
     * 该用户下的课程
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses()
    {
        return $this->hasMany(Course::class, 'user_id', 'id');
    }

    public function getShowUrlAttribute()
    {
        return route('backend.member.show', $this);
    }

    public function getCredit1TextAttribute()
    {
        return config('meedu.credit.credit1.name');
    }

    public function getCredit2TextAttribute()
    {
        return config('meedu.credit.credit2.name');
    }

    public function getCredit3TextAttribute()
    {
        return config('meedu.credit.credit3.name');
    }


}