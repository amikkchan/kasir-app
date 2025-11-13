<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password', 'role_id', 'photo'];
    protected $hidden = ['password', 'remember_token'];

    // ❌ Hapus relasi ini karena gak ada tabel roles
    // public function role(){
    //     return $this->belongsTo(Role::class);
    // }

    // ✅ Gunakan role_id langsung
    public function isAdmin()
    {
        // anggap role_id = 1 adalah admin
        return $this->role_id == 1;
    }
}
