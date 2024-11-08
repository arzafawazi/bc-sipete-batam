<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\TblAksesMenu;


class CheckMenuAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get current user
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        // Get current route path
        $currentPath = $request->path();

        // Get all menu items with YES access for current user
        $userAccess = TblAksesMenu::where('id_admin', $user->id_admin)
            ->where('opsi', 'YES')
            ->with('menu')
            ->get();

        // Convert route paths to menu paths
        $allowedPaths = $userAccess->map(function ($access) {
            $menu = $access->menu;
            if ($menu) {
                return strtolower(trim($menu->fd, '/'));
            }
            return null;
        })->filter()->toArray();

        // Check if current path matches any allowed paths
        $currentPathLower = strtolower(trim($currentPath, '/'));
        foreach ($allowedPaths as $allowedPath) {
            if (
                $currentPathLower === $allowedPath ||
                str_starts_with($currentPathLower, $allowedPath . '/')
            ) {
                return $next($request);
            }
        }

        // If path is in exclusion list, allow access
        $excludedPaths = [
            'home',
            'logout',
            'profile',
        ];

        if (in_array($currentPathLower, $excludedPaths)) {
            return $next($request);
        }

        // Access denied
        abort(403, 'Unauthorized access');
    }
}