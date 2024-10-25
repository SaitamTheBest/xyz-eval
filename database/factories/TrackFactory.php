<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Week;
use Database\Samples\TrackSamples;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Between yesterday and ~6 previous weeks
        $published_at = now()->subDays(rand(1, 80));

        return [
            'user_id' => User::factory(),
            'week_id' => Week::factory(),
            'category_id' => DB::table('categories')->inRandomOrder()->first()->id,
            'artist' => fake()->name(),
            'title' => fake()->sentence(2),
            'url' => fake()->randomElement(['https://youtube.com/watch?v=ID', 'https://soundcloud/USER/TRACK']),
            'created_at' => $published_at,
            'updated_at' => $published_at,
        ];
    }

    /**
     * Get track from real sample.
     */
    public function sample()
    {
        return $this->state(function (array $attributes) {
            return app(TrackSamples::class)->collect()->random();
        });
    }
}
