<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        if (User::count() == 0) {
            $role = Role::where('name', 'admin')->firstOrFail();
            $user = User::create([
                'name' => 'Admin',
                'email' => 'admin@bpa.cu',
                'password' => bcrypt('password'),
                'remember_token' => Str::random(60),
                'role_id'=> $role->id
            ]);


        }
    }
}
