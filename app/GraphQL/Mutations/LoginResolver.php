<?php

namespace App\GraphQL\Mutations;

use GraphQL\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
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
            $user = auth()->user();
            $token = Auth::user()->createToken('Access Token')->accessToken;
            //Cookie::queue('_token', $token, 1800, '/', $context->request->getHost(), false, true);

            return [
                'token' => $token,
                'name' => $user
            ];
        }
        return ['request'=>'none'];
    }
}
