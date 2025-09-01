<?php

namespace Database\Seeders;

use App\Models\Entities\Admin\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::truncate();
        //     first_name
        //     last_name
        //     document_number
        //     email
        //     username
        //     password
        //     email_verified_at
        //     start_date
        //     end_date
        //     rememberToken
        //     created_by
        //     updated_by

        $admin = new User();
        
        $admin->first_name = 'Adiministrador';
        $admin->document_number = '11222333';
        $admin->email = 'admin@sentinel.com';
        $admin->username = 'Admin';
        $admin->password = '$2a$12$W2NjJAwQkEmCznI2KirAY.JXvuVxCUmibHFpn/sCcCQjsTuUznqXq';
        $admin->email_verified_at = now();
        $admin->created_by = 1;
        $admin->updated_by = 1;
        $admin->save();


        User::factory(10)->create();
    }
}
