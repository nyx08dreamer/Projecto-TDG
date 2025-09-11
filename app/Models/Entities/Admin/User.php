<?php

namespace App\Models\Entities\Admin;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, HasFactory, Notifiable; 

    protected $table = "users";

    protected $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'document_number',
        'email',
        'username',
        'password',
        'start_date',
        'end_date',
        'image_path',

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
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

    protected static function newFactory()
        {
            return \Database\Factories\UserFactory::new();
        }


    public function get_users() {
        $resultado = self::select(
                'id',
                'first_name',
                'last_name',
                'document_number',
                'email',
                'username',
                'password',
                'start_date',
                'end_date',
            );

        return $resultado;
    }
}
