<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Task;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
			User::factory()->unverified()->create([
				'name' => 'Alesia',
				'email' => 'alesiatantsiurenko@gmail.com',
		]);
			User::factory(20)->unverified()->create();
			Task::factory(20)->create();
        /*User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);*/
    }
}