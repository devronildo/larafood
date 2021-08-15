<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;

use Illuminate\Database\Seeder;

class TenantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
               'cnpj' => '2388700600120',
               'name' => 'Rango da tati',
               'url' => 'rangodatati',
               'email' => 'rango@gmail.com'
         ]);
    }
}
