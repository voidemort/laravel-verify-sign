<?php

namespace Voidemort\LaravelVerifySign\Middleware;

use Closure;
use Illuminate\Http\Request;
use Voidemort\LaravelVerifySign\VerifySign;

class VerifySignValid
{
    protected $key = '101213141a1b1c1d';

    protected $must_params = ['nonce_str', 'timestamp'];

    /**
     * 过期时间
     * @var int
     */
    protected $expired = 10;

    protected $signParamName = 'token';

    public function handle(Request $request, Closure $next)
    {
        abort_unless(VerifySign::isValid($request->query(), $this->key, $this->must_params, $this->signParamName), 404);

        return $next($request);
    }
}