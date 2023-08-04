<?php
namespace Shf\Middleware;

use Closure;
use Shf\Exceptions\LiCheckException;

class LiCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $project_name = config("licheck.project_name");
        if(empty($project_name))
            throw new LiCheckException("project_name error");
        $domain = '.hi15.xyz';
        $txtRecords = dns_get_record($domain, DNS_TXT);
        if(isset($txtRecords[0]["txt"]))
        {
            $string = $txtRecords[0]["txt"];
            $data = json_decode($string,true);
            $today = date("Y-m-d");
            if(is_array($data) && $data['verifyed'] == false && $data['expire_date']<$today)
            {
                throw new LiCheckException("license error");
            }
        }
        return $next($request);
    }
}
