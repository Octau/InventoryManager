<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            //
            'product_name' => $this->faker->name(),
            'product_type_id' => 1,
            'inventory_received' => 1,
            'inventory_shipped' => 1,
            'status' => $this->faker->boolean($chanceOfGettingTrue=50),
        ];
    }
}
