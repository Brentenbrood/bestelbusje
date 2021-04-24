<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\Company;
use App\Models\CompanyCarModelPivot;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{

    public function showTotalCosts(Request $request)
    {
        $response = [];
        $km = $request->query('km');
        $days = $request->query('days');
        $volume = $request->query('volume');

        foreach(CarModel::where('volume', '>=', $volume)->with('companies')->has('companies')->get() as $car){
            $item = [];
            $item['car']['model'] = $car->model;
            $item['car']['volume'] = $car->volume;
            foreach($car->companies()->get() as $company){
                $item['company']['name'] = $company->name;
                $item['company']['website'] = $company->website;
                $item['pricing'] = $company->pricing->getTotalCosts($km, $days);
            }
            $response[] = $item;
        }

        // Sort by ascending total costs
        usort($response, function($a, $b) {
            return $a['pricing']['total_costs'] <=> $b['pricing']['total_costs'];
        });

        return $response;
    }
}
