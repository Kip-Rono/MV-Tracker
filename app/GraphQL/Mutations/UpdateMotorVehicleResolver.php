<?php

namespace App\GraphQL\Mutations;

use App\Models\MotorVehicle;

class UpdateMotorVehicleResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        //update MV details where reg_no
//        $mv = new MotorVehicle();
//        $mv -> fill($args['data']);
//        $mv -> update();

//        if ($mv){
//            return ['response'=>'MV Updated Successfully'];
//        }else{
//            return ['response'=>'Update Failed. Enter MV Details'];
//        }
    }
}
