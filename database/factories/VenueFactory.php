<?php

namespace Database\Factories;

use App\Models\Venue;
use App\Models\VenueCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class VenueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Venue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> [
                'ro' => $this->faker->text(50),
                'en' => $this->faker->text(50),
                'ru' => $this->faker->text(50),
            ],
            'body'=> [
                'ro' => $this->faker->text,
                'en' => $this->faker->text,
                'ru' => $this->faker->text,
            ],
            'sort_order' => 1,
            'venue_category_id' => VenueCategory::all()->random()->id,
            'status' => $this->faker->boolean(80),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Venue $venue) {
            //
        })->afterCreating(function (Venue $venue) {
            $venue->addMediaFromUrl('https://picsum.photos/450/300')->toMediaCollection('image');
        });
    }
}
