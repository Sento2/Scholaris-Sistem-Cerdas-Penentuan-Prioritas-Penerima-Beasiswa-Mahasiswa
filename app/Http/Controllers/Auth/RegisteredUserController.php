<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\Dosen;
use App\Services\UserService;
use App\Http\Requests\RegisterMahasiswaRequest;

class RegisteredUserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $dosens = Dosen::with('user')->get();
        return view('auth.register', compact('dosens'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(RegisterMahasiswaRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['role'] = 'mahasiswa'; // Force role mahasiswa for self-registration

        $user = $this->userService->createUser($data);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
