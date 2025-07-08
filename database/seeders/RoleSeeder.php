<?php

namespace Database\Seeders;

use App\Models\Quyen;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Quyen::create([
            'ten' => 'Supper Admin',
            'moTa' => 'Quản trị hệ thống',
        ]);
        Quyen::create([
            'ten' => 'Admin',
            'moTa' => 'Quản Trị Viên',
        ]);
    }
}