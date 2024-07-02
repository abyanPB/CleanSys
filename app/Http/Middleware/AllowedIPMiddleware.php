<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AllowedIPMiddleware
{
    public $allowedIps = [
        ['192.168.68.1', '192.168.68.254'],
        ['192.168.19.1', '192.168.19.254']
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $clientIp = $request->ip();
        $allowed = false;

        foreach ($this->allowedIps as $range) {
            if ($this->ipInRange($clientIp, $range[0], $range[1])) {
                $allowed = true;
                break;
            }
        }

        if ($allowed) {
            return $next($request);
        }

        return response()->view('error.405', ['title'=>'Halaman Tidak Punya Akses'], 403);
    }

    /**
     * Check if an IP address is within a range.
     *
     * @param  string  $ip
     * @param  string  $start
     * @param  string  $end
     * @return bool
     */
    private function ipInRange(string $ip, string $start, string $end): bool
    {
        $ipLong = ip2long($ip);
        $startLong = ip2long($start);
        $endLong = ip2long($end);

        return ($ipLong >= $startLong) && ($ipLong <= $endLong);
    }

}
