<?php

namespace Database\Factories;

use App\Models\usefulTab;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsefulTabFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = usefulTab::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> [
                'ro' => $this->faker->text(30),
                'en' => $this->faker->text(30),
                'ru' => $this->faker->text(30),
            ],
            'body'=> [
                'ro' => $this->faker->text,
                'en' => $this->faker->text,
                'ru' => $this->faker->text,
            ],
            'sort_order' => 1,
            'status' => $this->faker->boolean(80),
        ];
    }
}
