<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Faker\Factory as Faker;
use App\Models\Event;
use App\Models\Category;
use App\Models\User;
use App\Models\Reservation;

class SeedFakerData extends Command
{
    protected $signature = 'seed:faker';
    protected $description = 'Seed fake data for events, categories, and reservations';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $faker = Faker::create();

        // Seed categories
        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->word
            ]);
        }

        // Seed events
        for ($i = 0; $i < 50; $i++) {
            Event::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'date' => $faker->dateTimeBetween('+1 days', '+1 year'),
                'location' => $faker->address,
                'category_id' => Category::inRandomOrder()->first()->id
            ]);
        }

        // Seed users (assurez-vous que les utilisateurs existent dans la base)
        $users = User::factory()->count(20)->create();

        // Seed reservations
        for ($i = 0; $i < 100; $i++) {
            Reservation::create([
                'user_id' => $users->random()->id,
                'event_id' => Event::inRandomOrder()->first()->id,
                'status' => $faker->randomElement(['En attente', 'Confirmé', 'Annulé'])
            ]);
        }

        $this->info('Faker data seeded successfully.');
    }
}
