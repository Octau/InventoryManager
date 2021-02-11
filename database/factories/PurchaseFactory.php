<?php

namespace Database\Factories;

use App\Models\Purchase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Purchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'supplier_id' => 1,
          'product_id' => 1,
          'status' => $this->faker->boolean($chanceOfGettingTrue=50),
          'purchase_date' => $this->faker->date('Y-m-d'),
        ];
    }
}
