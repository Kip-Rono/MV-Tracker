<?php

namespace App\GraphQL\Mutations;

use App\Models\MotorVehicle;

class FetchMotorVehicleResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
        //fetch one mv
        $mv_details  = MotorVehicle::all();
    }
}
