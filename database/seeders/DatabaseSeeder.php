<?php

namespace Database\Seeders;

use Carbon\Factory;
use Database\Factories\CompanyCarModelPivotFactory;
use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\CarModel;
use App\Models\CompanyCarModelPivot;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        CarModel::factory(20)->create();
        Company::factory(10)->create();
        $faker = Faker\Factory::create();

        $car_models = CarModel::all();

        Company::all()->each(function ($company) use ($faker, $car_models) {
            $r = rand(1, 6);
            $company->carmodels()->attach(
                $car_models->random($r)->pluck('id')
            );
        });

        Company::all()->each(function($company) use ($faker){
            foreach($company->carmodels()->get() as $company) {
                $company->pricing->update(
                    ['costs_day' => $faker->randomFloat(2,20,60),
                    'costs_half_day' => $faker->randomFloat(2,10,20),
                    'costs_km' => $faker->randomFloat(2,0.10,0.50) ]);
            }
        });
    }
}
