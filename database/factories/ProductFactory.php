<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'pro_title' => $this->faker->text($max = 10),
            'category_id' => rand(1,4),
            'user_margin'=>$this->faker->randomElement([5.00,10.00,15.00]),
            'retail_margin'=>$this->faker->randomElement([10.00,15.00,20.00,25.00]),
            'pro_image'=>'image',
            'pro_qty'=>rand(12,23),
            'pro_description'=>$this->faker->words($max = 50),
            'pro_price'=>$this->faker->randomElement([200,400,500,600,700,550,200,650,780,570,440,300]),
        ];
    }
}
