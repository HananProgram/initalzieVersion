<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsurePasswordIsChanged
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->must_change_password && !$request->is('agency/change-password')) {
            return redirect()->route('agency.change-password');
        }

        return $next($request);
    }
}
