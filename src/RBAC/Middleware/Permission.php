<?php
/**
 * Created by PhpStorm.
 * User: fudenglong
 * Date: 2017/10/29
 * Time: 上午10:49
 */

namespace Gamelife\RBAC\Middleware;


use Closure;
use Illuminate\Http\Request;

class Permission
{
    const DELIMITER = '|';

    public function handle(Request $request, Closure $next, $permissions ='', $validateAll=false)
    {
        $permissions = is_array($permissions) ? $permissions : explode(static::DELIMITER, $permissions);
        $validateAll = is_bool($validateAll) ? $validateAll : filter_var($validateAll, FILTER_VALIDATE_BOOLEAN);
        if (!$request->user() or !$request->user()->hasPermissions($permissions, $validateAll)) {
            abort(403);
        }
        return $next($request);
    }

}