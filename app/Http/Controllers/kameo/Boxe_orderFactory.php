<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class Boxe_orderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'installation_price'        => $this->faker->randomFloat(2, 10, 2000),
            'amount'                    => $this->faker->randomFloat(2, 10, 2000),
            'estimated_delivery_date'   => $this->faker->date(),
            'boxes_id'                  => $this->faker->randomElement(\App\Models\Boxe::all()->pluck('id')),
            'boxes_catalog_id'          => $this->faker->randomElement(\App\Models\Boxes_catalog::all()->pluck('id')),
            'grouped_orders_id'         => $this->faker->randomElement(\App\Models\Grouped_order::all()->pluck('id')),
            'status'                    => $this->faker->randomElement(['new', 'confirmed', 'done'])
        ];
    }
}
