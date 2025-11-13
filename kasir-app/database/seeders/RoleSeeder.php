<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder {
    public function run(){
        $admin = Role::firstOrCreate(['name' => 'admin'], ['label'=>'Administrator']);
        $user  = Role::firstOrCreate(['name' => 'user'], ['label'=>'Kasir / User']);

        // buat akun admin default
        if(!User::where('email','admin@example.com')->exists()){
            User::create([
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
                'role_id' => $admin->id
            ]);
        }
    }
}
