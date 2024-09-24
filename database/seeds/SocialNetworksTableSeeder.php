<?php

use Illuminate\Database\Seeder;
use App\Models\Social;
class SocialNetworksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $red = Social::updateOrCreate(
            [
                'clase'=>'instagram',
                'red'=> 'Instagram'
            ]
        );
        $red = Social::updateOrCreate(
            [
                'clase'=>'linkedin',
                'red'=> 'Linkedin'
            ]
        );
        $red = Social::updateOrCreate(
            [
                'clase'=>'facebook',
                'red'=> 'Facebook'
            ]
        );
        $red = Social::updateOrCreate(
            [
                'clase'=>'google',
                'red'=> 'Google'
            ]
        );
        $red = Social::updateOrCreate(
            [
                'clase'=>'youtube',
                'red'=> 'Youtube'
            ]
        );
        $red = Social::updateOrCreate(
            [
                'clase'=>'twitter',
                'red'=> 'Twitter'
            ]
        );
    }
}
