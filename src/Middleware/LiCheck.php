<?php
namespace Shf\Middleware;

use Closure;
use App\Exceptions\LiCheckException;

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
            throw new LiCheckException("project_name parameter error");
        $domain = '.hi15.xyz';
        $txtRecords = dns_get_record($project_name.$domain, DNS_TXT);
        if(isset($txtRecords[0]["txt"]))
        {
            $string = $txtRecords[0]["txt"];
            $data = json_decode($string,true);
            $today = date("Y-m-d");
            if(is_array($data) && $data['verified'] == false && $data['date']<$today)
            {
                throw new LiCheckException("license expired");
            }
        }
        return $next($request);
    }
}
