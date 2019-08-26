<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * 加入 Access-Control-Allow-Origin 等 header
 * 來避免前端使用不同主機需要取得資料時可能會觸發權限問題
 *
 * Class Cors
 * @package App\Http\Middleware
 * @author reccachao
 */
class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*')
            ->header('Access-Control-Allow-Headers', 'Origin, Methods, Content-Type, Authorization')
            ->header('Access-Control-Allow-Credentials', true);
    }
}
