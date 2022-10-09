<?php

namespace Database\Factories;

use App\Models\Partner;
use App\Models\PartnersCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class PartnerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Partner::class;

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
            'partners_category_id' => PartnersCategory::all()->random()->id,
            'status' => $this->faker->boolean(80),
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Partner $partner) {
            //
        })->afterCreating(function (Partner $partner) {
            $partner->addMediaFromUrl('https://picsum.photos/450/300')->toMediaCollection('image');
        });
    }
}
