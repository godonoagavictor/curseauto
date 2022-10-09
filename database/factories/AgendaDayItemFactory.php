<?php

namespace Database\Factories;

use App\Models\AgendaDay;
use App\Models\AgendaDayItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgendaDayItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgendaDayItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> [
                'ro' => $this->faker->text(20),
                'en' => $this->faker->text(20),
                'ru' => $this->faker->text(20),
            ],
            'body'=> [
                'ro' => $this->faker->text(1000),
                'en' => $this->faker->text(1000),
                'ru' => $this->faker->text(1000),
            ],
            'agenda_day_id' => AgendaDay::all()->random()->id,
            'status' => $this->faker->boolean(80),
            'sort_order' => 1,
        ];
    }
}
