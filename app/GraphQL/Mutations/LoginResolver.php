<?php

namespace App\GraphQL\Mutations;

use App\Models\User;
<<<<<<< HEAD
use Facade\Ignition\QueryRecorder\Query;
=======
>>>>>>> 137579c44981da86400e5e7bd90524b8edf9ecb3
use GraphQL\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use http\Cookie;
use http\QueryString;
use Illuminate\Support\Facades\Auth;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;

class LoginResolver
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args, GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        // TODO implement the resolver
        //$args = (object)$args;
       //fetch user where name entered
        $user = User::select('email', 'password')->where('email', $args['data']['email'])->get();

        if ($args['data']['email'] != $user[0]->email ||  hash('sha256', $args['data']['password']) != $user[0]->password) {
            //throw new AuthenticationException('Authentication Failed. Username or password is incorrect');
            return [
                'token' => '',
                'response' => 'Authentication failed. Username or password is incorrect'
            ];
        }

        //Create Personal Access Token and return a JWT
        else {
//            mutation
            //return ['request'=>'success'];
            // $user = auth()->user();
            $user = User::where('email', $args['data']['email'])->pluck('name');
            $token = Auth::user()->createToken('Access Token')->accessToken;
            //Cookie::queue('_token', $token, 1800, '/', $context->request->getHost(), false, true);

            return [
                'token' => $token,
                'response' => 'Login Successful'
                //'name' => $user,
            ];
        }
        return ['request'=>'none'];
    }
}
