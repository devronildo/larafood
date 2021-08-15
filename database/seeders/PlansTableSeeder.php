<?php
namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
           'name' => 'basic',
           'url' => 'basic',
           'price' => 29.99,
           'description' => 'Plano Empresarial'
        ]);
    }
}
