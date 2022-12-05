<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Location;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $role = Role::find(1);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);

        Location::create([
            'user_id' => $user->id,
            'user_ip' => '127.0.0.1',
            'login_at' => now(),
        ]);



        // just insert one user data
        $one_user = User::create([
            'first_name' => 'Faisal',
            'last_name' => 'Ahmmed',
            'email' => 'developerfaisal32@gmail.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        $one_user->assignRole('User');

        Location::create([
            'user_id' => $one_user->id,
            'user_ip' => '127.0.0.1',
            'login_at' => now(),
        ]);
    }
}
