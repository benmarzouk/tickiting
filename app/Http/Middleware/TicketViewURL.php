<?php

namespace App\Http\Middleware;

use Closure;
use Input;

//use Redirect;

class TicketViewURL
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // dd(\Input::all(), $request->fullUrl());
        $request_str = $request->fullUrl();
        if (preg_match('([^D]=)', $request_str) == 1) {
            $request_str = str_replace('=', '%5B%5D=', $request_str);
            $request_str = str_replace('%5B%5D%5B%5D=', '%5B%5D=', $request_str);
        }
        if (count(Input::all()) == 0) {
            return \Redirect::to('tickets?show%5B%5D=inbox&departments%5B%5D=All');
        } else {
            if (!array_key_exists('show', Input::all()) && !array_key_exists('departments', Input::all())) {
                return \Redirect::to($request_str.'&show%5B%5D=inbox&departments%5B%5D=All');
            } elseif (!array_key_exists('show', Input::all()) && array_key_exists('departments', Input::all())) {
                return \Redirect::to($request_str.'&show%5B%5D=inbox');
            } elseif (array_key_exists('show', Input::all()) && !array_key_exists('departments', Input::all())) {
                return \Redirect::to($request_str.'&departments%5B%5D=All');
            } else {
                // do nothing
            }
            if (preg_match('([^D]=)', $request->fullUrl()) == 1) {
                return \Redirect::to($request_str);
            }

            return $next($request);
        }
    }
}
