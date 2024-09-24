<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role = Role::firstOrNew(['name' => 'Admin']);
        if (!$role->exists) {
            $role->save();
        }
    }
}
