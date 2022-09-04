<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;


class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    Admin::create(['username'=>'admin', 'email'=>'mengyi.yoeng34@gmail.com',  'password'=> Hash::make('1234'), 'profile_image' => 'admin.jpg']);
    }
}
