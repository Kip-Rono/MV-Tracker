<?php

namespace App\GraphQL\Mutations;

use App\Models\MotorVehicle;

class RegisterMotorVehicleResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        $mv = new MotorVehicle();
        $mv -> fill($args['data']);
        $mv -> save();

        if ($mv){
            return ['response'=>'MV Created Successfully'];
        }else{
            return ['response'=>'Save Failed. Enter MV Details'];
        }
    }
}
