<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\CompanyCarModelPivot
 *
 * @property int $company_id
 * @property int $car_model_id
 * @property float $costs_day
 * @property float $costs_half_day
 * @property float $costs_km
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CompanyCarModelPivotFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot query()
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot whereCarModelId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot whereCompanyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot whereCostsDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot whereCostsHalfDay($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot whereCostsKm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CompanyCarModelPivot whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CompanyCarModelPivot extends Pivot
{
    use HasFactory;

    protected $hidden = ['company_id', 'car_model_id', 'created_at', 'updated_at'];

    public function getTotalCosts($km, $days) {
        $response = [];

        $nearest_km = round($km / 50) * 50;
        if($nearest_km == 0)
            $nearest_km = 50;

        $whole_days = (int) $days;

        if($days-$whole_days == 0.5){
            $response['total_costs_days'] = $this->costs_half_day;
        } else {
            $response['total_costs_days'] = 0;
        }

        $response['total_costs_per_km'] = round((float)$this->costs_km,2);
        $response['total_costs_distance'] = round($this->costs_km * $nearest_km,2);
        $response['total_costs_days'] = round(($this->costs_day * (int)$days) + $response['total_costs_days'],2);
        $response['total_costs'] = round($response['total_costs_distance'] + $response['total_costs_days'],2);

        return $response;

    }
}
