<?php

namespace App\Http\Controllers\MV;

use App\Http\Controllers\Controller;
use App\Models\MotorVehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function Sodium\increment;

class RegisterMVController extends Controller
{
    //
    public function index(){
        return view('MV/register_mv');
    }

    public function fetchMVDetails(){
        return view('MV/update_mv');
    }

    //list all MVs view
    public function listAllMVs(){
        return view('MV/list_all_mvs');
    }

    //save MV regsitration
    public function saveRegisterMV(Request $request){
        //return $request;
        //save into motor vehicle tables
        try {
            $max_id = MotorVehicle::max('id') + 1;

            DB::transaction(function () use ($request){
                MotorVehicle::create([
                    //'id' => $max_id,
                    'name' => $request->name,
                    'reg_no' => $request->reg_no,
                    'year_of_man' => $request->year_of_manufacture,
                    'vehicle_type' => $request->vehicle_type,
                    'tonnage' => $request->tonnage,
                ]);
            });
            return ['response' => 'MV Details Saved Successfully'];
        }catch (\Exception $e){
            return ['error' => $e->getMessage()];
        }
    }

}
