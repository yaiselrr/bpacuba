<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(RolesTableSeeder::class);
         $this->call(PermissionsTableSeeder::class);
         $this->call(PermissionsRoleTableSeeder::class);
         $this->call(AdminTableSeeder::class);
         $this->call(ServicesTableSeeder::class);
//         $this->call(ServicesFilesTableSeeder::class);
         $this->call(StaticsTableSeeder::class);
         $this->call(AboutUsTableSeeder::class);
         $this->call(InfoTableSeeder::class);
         $this->call(InfoImagesTableSeeder::class);
         $this->call(SocialNetworksTableSeeder::class);
         $this->call(SiteDataTableSeeder::class);
         $this->call(TaxesTableSeeder::class);
         $this->call(ContactCentralTableSeeder::class);
    }
}
