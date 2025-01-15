<?php

namespace Database\Seeders;

use App\Models\Info;
use App\Models\Quyen;
use Illuminate\Database\Seeder;

class InfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Info::create([
            'ten' => 'Nguyễn Hải Nam',
            'moTa' => 'Quản trị hệ thống',
        ]);
        Info::create([
            'ten' => 'Vũ Văn B',
            'moTa' => 'Quản Trị Viên',
        ]);
    }
}