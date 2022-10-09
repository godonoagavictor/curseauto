<?php

namespace Database\Factories;

use App\Models\PartnersCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnersCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PartnersCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=> [
                'ro' => $this->faker->text(20),
                'en' => $this->faker->text(20),
                'ru' => $this->faker->text(20),
            ],
            'sort_order' => 1,
        ];
    }
}
