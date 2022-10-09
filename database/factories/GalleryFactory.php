<?php

namespace Database\Factories;

use App\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => [
                'ro' => $this->faker->text,
                'en' => $this->faker->text,
                'ru' => $this->faker->text,
            ],
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Gallery $gallery) {
            //
        })->afterCreating(function (Gallery $gallery) {
            $gallery->addMediaFromUrl('https://picsum.photos/450/300')->toMediaCollection('image');
        });
    }
}
