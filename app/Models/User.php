<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'prefixname',
        'firstname',
        'middlename',
        'lastname',
        'suffixname',
        'email',
        'password',
        'photo',
        'type',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
    */
    protected $table = 'users';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Append additiona info to the return data
     *
     * @var string
     */
	public $appends = [
        'avatar',
        'fullname',
        'middleinitial',
        'details',
    ];

    public function getDetails()
    {   
        return $this->hasMany('App\Models\Detail', 'user_id', 'id');
    }

    /****************************************
    *           ATTRIBUTES PARTS            *
    ****************************************/
    public function getAvatarAttribute() 
    {
        return $this->photo;
    }

    public function getFullnameAttribute() 
    {
        return $this->firstname.' '.$this->middlename.'. '.$this->lastname;
    }

    public function getMiddleinitialAttribute() 
    {
        return $this->middlename;
    }

    public function getDetailsAttribute() 
    {
        return $this->getUserDetails()->pluck('key','value')->toArray();
    }
}
