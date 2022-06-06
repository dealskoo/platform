<?php

namespace Database\Factories\Dealskoo\Platform\Models;

use Dealskoo\Platform\Models\Platform;
use Dealskoo\Seller\Models\Seller;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlatformFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Platform::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug,
            'name' => $this->faker->name,
            'website' => $this->faker->domainName,
            'logo' => $this->faker->imageUrl,
            'score' => $this->faker->numberBetween(0, 5),
            'description' => $this->faker->text,
            'seller_id' => Seller::factory(),
            'country_id' => function ($platform) {
                return Seller::find($platform['seller_id'])->country_id;
            },
        ];
    }

    public function approved()
    {
        return $this->state(function (array $attributes) {
            return [
                'approved' => true,
            ];
        });
    }
}
