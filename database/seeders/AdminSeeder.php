<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Demo admin account. Change the password before any real use.
        $admin = User::firstOrNew(['email' => 'admin@medly.test']);
        $admin->name = 'Medly Admin';
        $admin->password = Hash::make('password');
        $admin->role = 'admin';
        $admin->save();
    }
}
