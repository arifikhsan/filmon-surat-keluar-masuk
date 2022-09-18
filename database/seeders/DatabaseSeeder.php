<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Letter;
use App\Models\Sender;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => 'Akademik',
            'email' => 'akademik@gmail.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Ketua',
            'email' => 'ketua@gmail.com',
            'password' => bcrypt('123456')
        ]);

        User::create([
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('123456')
        ]);

        Department::create([
            'name' => 'Akademik',
        ]);

        Department::create([
            'name' => 'Agama',
        ]);

        Department::create([
            'name' => 'Teologi',
        ]);

        Sender::create([
            'name' => 'Bapak Yanto',
            'address' => 'Jl. Kebon Jeruk',
            'phone' => '08123456789',
            'email' => 'yanto@gmail.com'
        ]);

        // Letter::create([
        //     'letter_no' => '123',
        //     'letter_date' => '2021-01-01',
        //     'date_received' => '2021-01-01',
        //     'regarding' => 'Pengajuan Cuti',
        //     'department_id' => 1,
        //     'sender_id' => 1,
        //     'letter_file' => File
        //     'letter_type' => 'Surat Masuk'
        // ]);
    }
}
