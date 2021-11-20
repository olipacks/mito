<?php

namespace Mito\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class EnsureUserIsAuthorized
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return void|Closure
     */
    public function handle($request, Closure $next)
    {
        $allowed = app()->environment('local')
            || Gate::allows('viewMito', [$request->user()]);

        abort_unless($allowed, 403);

        return $next($request);
    }
}
