<?php
namespace App\Http\Middleware;

use Closure;
use App\Services\Utility\ILoggerService;

class MySecurityMiddleware {
    // public function __construct(ILoggerService $logger) {
    //     $this->logger = $logger;
    // }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        //step 1: you can use the following to get the route uri $request->path()
        // or you can also use the $request->is()
        $path = $request->path();
        // $this->logger->info("Entering My Security Middleware in handle() at path: " . $path);

        //step 2: run the business rules that check for all uri's that you do not need to secure
        $secureCheck = true;
        if ($request->is('login') || $request->is('register'))
            $secureCheck = false;
        // $this->logger->info($secureCheck ? "Security middleware in handle()... Needs security" : "Security middleware in handle()...No security required");

        //step 3: if entering a secure uri with no security token then do a redirect to the root uri or login page (not $enable variable is to easily disable security)
//         $enable = false;
        if ($request->session()->has('user_id') == null && $secureCheck) {
            // $this->logger->info("Leaving My Security middleware in handle() doing a redirect back to login");
            return redirect('/login');
        }
        //proceed as normal to next middleware in the chain
        return $next($request);

    }
}
