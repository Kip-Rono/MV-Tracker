<?php

namespace App\GraphQL\Mutations;

use App\Models\User;

class RegisterUserResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        //return ['response' => $args];
        // TODO implement the resolver
        //register new user
        $user = new User();
        $password = encrypt($args['data']['password1']);
        $user -> fill($args['data']);
        $user->password = $password;
        $user -> save();

        if ($user){
            return ['response'=>'User Created Successfully'];
        }else{
            return ['response'=>'Save Failed. Enter User Details'];
        }
    }
}
