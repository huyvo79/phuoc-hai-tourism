<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;


class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $ip = $request->ip();
        $today = Carbon::today();

        // Kiểm tra xem IP này hôm nay đã vào chưa (tránh F5 tăng view liên tục)
        $hasVisited = Visitor::where('ip_address', $ip)
                             ->where('visit_date', $today)
                             ->exists();

        if (!$hasVisited) {
            Visitor::create([
                'ip_address' => $ip,
                'user_agent' => $request->userAgent(),
                'visit_date' => $today
            ]);
        }

        return $next($request);
    }
}
