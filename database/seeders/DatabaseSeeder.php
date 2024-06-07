<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // DB::table('permissions')->insert([
        //     'permission_name' => 'admin',
        // ]);
        // DB::table('positions')->insert([
        //     'position_name' => 'manager'
           
        // ]);
        DB::table('NguoiDung')->insert([
            'TenDangNhap' => 'admin',
            'MatKhau'=>  Hash::make(123456),
            'Email' => 'admin@gmail.com',
            'HoTen' => 'Cao Nhật Linh',
            'GioiTinh' => 'Nam',
            'NgaySinh' => '2002-1-1',
            'AnhDaiDien' => 'https://img.freepik.com/free-psd/3d-illustration-human-avatar-profile_23-2150671142.jpg',
            'NgayDangKy' => now()->format('Y-m-d')
        ]);
    }
}
