<?php

namespace Database\Factories;

use App\Models\CarModel;
use App\Models\Company;
use App\Models\CompanyCarModelPivot;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyCarModelPivotFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CompanyCarModelPivot::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'costs_day' => $this->faker->randomFloat(2,20,60),
            'costs_half_day' => $this->faker->randomFloat(2,10,30),
            'costs_km' => $this->faker->randomFloat(2,0.10,0.50)
        ];
    }
}
