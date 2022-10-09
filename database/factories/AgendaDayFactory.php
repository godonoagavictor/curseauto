<?php

namespace Database\Factories;

use App\Models\AgendaDay;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaDayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgendaDay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'day'=> [
                'ro' => $this->faker->text(20),
                'en' => $this->faker->text(20),
                'ru' => $this->faker->text(20),
            ],
            'sort_order' => 1,
        ];
    }
}
