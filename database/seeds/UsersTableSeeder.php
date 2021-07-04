<?php

use App\Models\User;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'Ronildo Souza',
            'email' => 'ronildo@teste.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
