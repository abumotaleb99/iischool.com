<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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
    ];

    static public function getUserByEmail($email) {
        return User::where('email', '=', $email)->first();
    }

    static public function getUserByToken($remember_token) {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    static public function getAllAdminUsers() {
        $result = User::select('users.*')
                        ->where('role', '=', 1);

                        if(!empty(Request::get('name'))) {
                            $result = $result->where('name', 'like', '%'. Request::get('name'). '%');
                        }
                        if(!empty(Request::get('email'))) {
                            $result = $result->where('email', 'like', '%'. Request::get('email'). '%');
                        }
                        if(!empty(Request::get('date'))) {
                            $result = $result->where('created_at', 'like', '%'. Request::get('date'). '%');
                        }

        $result = $result->orderBy('id', 'desc')
                        ->paginate(10);
        
        return $result;
    }

    static public function getSingleAdminUserById($id) {
        return User::find($id);
    }
}
