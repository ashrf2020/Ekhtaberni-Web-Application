<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Traits\AuthTrait;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use AuthTrait;
    /**
     * Display the login view.
     */
    public function loginForm($type){

        return view('auth.login',compact('type'));
    }

    /**
     * Handle multi-guard login based on provided type (admin/web, student, parent, teacher).
     */
    public function login(Request $request): RedirectResponse
    {
        // Validate input
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
            'type' => ['nullable', 'string'],
        ]);

        // Determine guard from type
        $guard = $this->checkGuard($request);

        // Attempt authentication on the selected guard
        if (Auth::guard($guard)->attempt(
            ['email' => $credentials['email'], 'password' => $credentials['password']],
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();
            return $this->redirect($request);
        }

        // On failure, redirect back with error
        return back()->withErrors([
            'email' => trans('auth.failed'),
        ])->onlyInput('email');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return $this->redirect($request);

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (auth('student')->check()) {
            Auth::guard('student')->logout();
        } elseif (auth('teacher')->check()) {
            Auth::guard('teacher')->logout();
        } elseif (auth('parent')->check()) {
            Auth::guard('parent')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}