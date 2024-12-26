<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        // تحويل الأدوار المرسلة من سلسلة نصية إلى مصفوفة
        $rolesArray = explode('|', $roles);

        // التحقق إذا كان دور المستخدم موجودًا ضمن الأدوار المسموحة
        if (!in_array(auth()->user()->u_role_id, $rolesArray)) {
            return response()->view('errors.no_permission');
        }

        return $next($request);
    }
}
