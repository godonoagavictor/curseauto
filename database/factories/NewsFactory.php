<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> [
                'ro' => $this->faker->text,
                'en' => $this->faker->text,
                'ru' => $this->faker->text,
            ],
            'body' => [
                'ro' => $this->faker->text(1000),
                'en' => $this->faker->text(1000),
                'ru' => $this->faker->text(1000),
            ],
            'event_at' => $this->faker->date(),
            'status' => $this->faker->boolean(80),
            'main' => $this->faker->boolean(0),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (News $news) {
            //
        })->afterCreating(function (News $news) {
            $news->addMediaFromUrl('https://picsum.photos/450/300')->toMediaCollection('image');
        });
    }
}
