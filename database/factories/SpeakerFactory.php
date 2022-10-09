<?php

namespace Database\Factories;

use App\Models\Speaker;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpeakerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Speaker::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => [
                'ro' => $this->faker->text,
                'en' => $this->faker->text,
                'ru' => $this->faker->text,
            ],
            'sort_order' => 1,
            'status' => $this->faker->boolean(80),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterMaking(function (Speaker $speaker) {
            //
        })->afterCreating(function (Speaker $speaker) {
            $speaker->addMediaFromUrl('https://picsum.photos/450/300')->toMediaCollection('image');
        });
    }
}
