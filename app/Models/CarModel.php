<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * App\Models\CarModel
 *
 * @property int $id
 * @property string $model
 * @property int $volume
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Company[] $companies
 * @property-read int|null $companies_count
 * @method static \Database\Factories\CarModelFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel query()
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CarModel whereVolume($value)
 * @mixin \Eloquent
 */
class CarModel extends Model
{
    use HasFactory;

    protected $hidden = ['id','created_at', 'updated_at'];

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'company_car_model_pivot')->withPivot('costs_day', 'costs_half_day', 'costs_km')->using(CompanyCarModelPivot::class)->as('pricing');
    }
}
