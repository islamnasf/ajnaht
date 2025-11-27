<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    public function run()
    {
        DB::table('site_data')->insert([
            'name'        => 'My Company',
            'logo'        => 'uploads/logo.png',
            'description' => 'This is a short description about the company.',
            'imageHeader' => 'uploads/header.jpg',
            'textarea'    => 'This is a long text for testing the textarea field in settings table.',
            'aboutImage'  => 'uploads/about.jpg',
            'faceLink'    => 'https://facebook.com/',
            'instaLink'   => 'https://instagram.com/',
            'wattsLink'   => 'https://wa.me/201234567890',
            'phone1'      => '+201234567890',
            'phone2'      => '+201098765432',
            'email'       => 'info@example.com',
            'location'    => 'Madinah, Saudi Arabia',
            'address'    => 'Madinah, Saudi Arabia',
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);
    }
}
