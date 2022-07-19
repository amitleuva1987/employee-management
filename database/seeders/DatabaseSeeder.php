<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //   Company::factory()->hasemployees(12)->count(12)->create();
        \App\Models\User::factory(60000)->create();
    }
}
