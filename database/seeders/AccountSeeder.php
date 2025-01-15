<?php

namespace Database\Seeders;

use App\Models\TaiKhoan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TaiKhoan::create([
            'email' => 'admin@gmail.com',
            'matKhau' => Hash::make('12341234'),
            'quyenID' => '1',
            'thongTinTaiKhoanID' => '1',
        ]);
        TaiKhoan::create([
            'email' => 'nv@gmail.com',
            'matKhau' => Hash::make('12341234'),
            'quyenID' => '2',
            'thongTinTaiKhoanID' => '2',
        ]);
    }
}