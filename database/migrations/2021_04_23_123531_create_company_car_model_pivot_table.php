<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyCarModelPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_car_model_pivot', function (Blueprint $table) {
            $table->foreignId('company_id')->references('id')->on('companies')->cascadeOnDelete();;
            $table->foreignId('car_model_id')->references('id')->on('car_models')->cascadeOnDelete();;
            $table->decimal('costs_day', 19, 4)->default(0.00);
            $table->decimal('costs_half_day', 19, 4)->default(0.00);
            $table->decimal('costs_km', 19, 4)->default(0.0000);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company_car_model_pivot');
    }
}
