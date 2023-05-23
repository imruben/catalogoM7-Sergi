<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Burgir;
use Faker\Generator as Faker;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BurgirFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Burgir::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = app(Faker::class);
        return [
            'name' => $faker->words(1, true) . ' Burger',
            'price' => $this->faker->randomNumber(2),
            //'user_id' => rand(1, 10),
        ];
    }
}
