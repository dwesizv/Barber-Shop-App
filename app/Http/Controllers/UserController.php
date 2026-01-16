<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminMiddleware;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{

    function __construct() {
        $this->middleware(AdminMiddleware::class);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return view('user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $rols = ['user', 'advanced', 'admin'];
        return view('user.create', ['rols' => $rols]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse {
        $user = new User($request->all());
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        $rols = ['user', 'advanced', 'admin'];
        return view('user.edit', [
            'user' => $user,
            'rols' => $rols
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user): RedirectResponse
    {
        $user->fill($request->all());
        $user->save();
        return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();
        return redirect()->route('user.index');
    }
}
