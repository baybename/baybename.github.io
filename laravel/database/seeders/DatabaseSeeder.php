<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create(); //tạo ra danh sách 10 người trong bảng user
//điều này cần thiết khi ta làm việc với db không bị trống
        \App\Models\Task::factory(20)->create();
        //tạo 2 email chưa được xác minh.được khai báo trong file data
        \App\Models\User::factory(2)->unverified()->create();

    }
}
