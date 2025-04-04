<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Enums\LanguageCode;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

final class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->segment(1);

        if (! in_array($locale, LanguageCode::values(), true)) {
            abort(404);
        }

        app()->setLocale($locale);

        URL::defaults(['locale' => $locale]);

        return $next($request);
    }
}
