<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Seeders\RoleAccountSeeder;  // Correct namespace

class DatabaseSeeder extends Seeder
{
  /**
   * Seed the application's database.
   */
  public function run(): void
  {
    // Optional: Call other seeders, like User seeding
    // User::factory(10)->create();
    User::factory()->create([
      'name' => 'Test User',
      'email' => 'test@example.com',
    ]);

    // Run the RoleAccountSeeder
    $this->call(RoleAccountSeeder::class);
  }
}
