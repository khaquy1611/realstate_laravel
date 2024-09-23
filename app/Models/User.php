<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use App\Enums\RoleEnum;
use Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'created_at',
        'username',
        'name',
        'address',
        'phone',
        'website',
        'google2fa_secret',
    ];
    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    static public function getRecord($request) {
        $resultQuery = self::select('users.*')
                    ->orderBy('id', 'desc');
                    if (!empty(Request::get('id'))) {
                        $resultQuery =  $resultQuery->where('users.id', '=' , Request::get('id'));
                    }
                    if (!empty(Request::get('name'))) {
                        $resultQuery =  $resultQuery->where('users.name', 'like' , '%' . Request::get('name') . '%');
                    }
                    if (!empty(Request::get('username'))) {
                        $resultQuery =  $resultQuery->where('users.username', 'like' , '%' . Request::get('username') . '%');
                    }
                    if (!empty(Request::get('email'))) {
                        $resultQuery =  $resultQuery->where('users.email', '=' , Request::get('email'));
                    }
                    if (!empty(Request::get('phone'))) {
                        $resultQuery =  $resultQuery->where('users.phone', '=', Request::get('phone'));
                    }
                    if (!empty(Request::get('address'))) {
                        $resultQuery =  $resultQuery->where('users.address', 'like' , '%' . Request::get('address') . '%');
                    }
                    
                    if (!empty(Request::get('website'))) {
                        $resultQuery =  $resultQuery->where('users.website', '=', Request::get('website'));
                    }

                    if (!empty(Request::get('start_date')) && !empty(Request::get('end_date'))) {
                        $resultQuery =  $resultQuery->where('users.created_at', '>=' , Request::get('start_date'))
                                                    ->where('users.created_at', '<=' , Request::get('end_date'));
                    }
                   
                   
                    if (!empty(Request::get('role'))) {
                        $resultQuery =  $resultQuery->where('users.role', '=' , Request::get('role'));
                    }
                    
                    if (!empty(Request::get('status'))) {
                        $resultQuery =  $resultQuery->where('users.status', '=' , Request::get('status'));
                    }
        $resultQuery = $resultQuery->paginate(5);
        $resultQuery->appends($request->all());
        return $resultQuery;
    }

    public function emails()
    {
        return $this->hasMany(ComposeEmail::class, 'user_id');
    }
}