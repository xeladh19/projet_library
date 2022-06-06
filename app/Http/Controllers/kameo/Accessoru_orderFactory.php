<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Accessory_orderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'size'                      => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'UNIQUE']),
            'type'                      => $this->faker->randomElement(['selling', 'leasing']),
            'amount'                    => $this->faker->randomFloat(2, 10, 100),
            'description'               => $this->faker->sentence(),
            'estimated_delivery_date'   => $this->faker->date(),
            'delivery_date'             => $this->faker->date(),
            'grouped_orders_id'         => $this->faker->randomElement(\App\Models\Grouped_order::all()->pluck('id')),
            'accessories_catalog_id'    => $this->faker->randomElement(\App\Models\Accessories_catalog::all()->pluck('id')),
            'accessories_id'            => $this->faker->randomElement(\App\Models\Accessory::all()->pluck('id'))

        ];
    }
}
