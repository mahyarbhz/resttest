<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->ezData();
    }

    private function ezData() {
        User::create([
            'name' => 'Mahyar',
            'email' => 'a@a.com',
            'password' => Hash::make('password'),
        ]);
    }
}
