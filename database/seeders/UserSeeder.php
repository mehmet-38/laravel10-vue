<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("users")->delete();

        $defaultData =
            [
                [
                    "id" => 1,
                    'name' => 'System',
                    'email' => 'admin@admin.com',
                    'password' => '$2y$10$WGerOaCXGZy2rPNkQ6QYreHCKcp/FotVhwT7CE75L2PFb1Knh5KoO',
                ],
                [
                    "id" => 2,
                    'name' => 'Furkan Güzelgörür',
                    'email' => 'test@test.com',
                    'password' => '$2y$10$WGerOaCXGZy2rPNkQ6QYreHCKcp/FotVhwT7CE75L2PFb1Knh5KoO',
                ],
            ];

        User::query()->insert($defaultData);
    }
}
