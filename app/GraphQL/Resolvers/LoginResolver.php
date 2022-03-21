<?php

namespace App\GraphQL\Resolvers;

use GraphQL\Type\Definition\ResolveInfo;
use Illuminate\Support\Arr;
use Nuwave\Lighthouse\Support\Contracts\GraphQLContext;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Psy\Util\Str;
use Illuminate\Support\Facades\Request;

class LoginResolver
{

    /**
     * @param $rootValue
     * @param array $args
     * @param \Nuwave\Lighthouse\Support\Contracts\GraphQLContext|null $context
     * @param \GraphQL\Type\Definition\ResolveInfo $resolveInfo
     * @return array
     * @throws \Exception
     */
    public function resolve($rootValue,  array $args , GraphQLContext $context, ResolveInfo $resolveInfo)
    {
        //$args = (object)$args;
        //return ['request' => $args];
        //return [$rootValue, $args, $context, $resolveInfo];
        if (! Auth::once(['email' => $args['data']['email'], 'password' => $args['data']['password']])) {
            //return ['request'=>'error'];
            throw new AuthenticationException('Authentication Failed');
            return ['message' => 'Authentication failed. Username or password is incorrect'];
        }

        //Create Personal Access Token and return a JWT
        if (! $context->request->hasCookie('_token')) {
            //return ['request'=>'success'];
            $user = \auth()->user();
            $token = Auth::user()->createToken('Access Token')->accessToken;
            //Cookie::queue('_token', $token, 1800, '/', $context->request->getHost(), false, true);

            return [
                'token' => $token,
                'username' => $user
            ];
        }
        return ['request'=>'none'];


//        $credentials = Arr::only($args, ['email', 'password']);
//
//        if (Auth::once($credentials)) {
//            $token = Str::random(60);
//
//            $user = auth()->user();
//            $user->api_token = $token;
//            $user->save();
//
//            //return true;
//            return [
//                'token' => $token,
//                'username' => $user
//            ];
//        }
//
//        return ['message' => 'Authentication failed. Try Again'];
        //return false;
    }
}
