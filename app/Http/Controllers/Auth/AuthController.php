<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            if (in_array($user->role, ['admin', 'superadmin'])) {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('app.home');
        }
        return back()->withErrors(['email' => 'Email və ya parol səhvdir.']);
    }

    public function register(StoreUserRequest $request)
    {
        $validated = $request->validated();
        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('uploads/users/avatars', 'public');
        }
        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        return redirect()->back();
    }

    public function destroy(User $user)
    {
        try {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $user->delete();

            return response()->json(['message' => 'Silinmə müvəffəqiyyətlə yerinə yetirildi'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Silinmə zamanı xəta baş verdi'], 500);
        }
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    public function updateProfile(StoreUserRequest $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:25',
            'position_id' => 'required|exists:positions,id',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        if ($request->hasFile('avatar')) {
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('uploads/users/avatars', 'public');
        } else {
            $validated['avatar'] = $user->avatar;
        }
        $user->update($validated);

        return redirect()->back()->with('success', 'Profil məlumatları uğurla yeniləndi');
    }

    public function createPosition(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        Position::create($validated);
        return redirect()->back();
    }

    public function deletePosition(Position $position)
    {

        try {

            $position->delete();

            return response()->json(['message' => 'Silinmə müvəffəqiyyətlə yerinə yetirildi'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Silinmə zamanı xəta baş verdi'], 500);
        }
    }
}
