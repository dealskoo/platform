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
        $seller = Seller::factory()->create();

        return [
            'slug' => $this->faker->unique()->slug,
            'name' => $this->faker->name,
            'website' => $this->faker->url,
            'logo' => $this->faker->imageUrl,
            'score' => $this->faker->numberBetween(0, 5),
            'description' => $this->faker->text,
            'country_id' => $seller->country_id,
            'seller_id' => $seller->id
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
