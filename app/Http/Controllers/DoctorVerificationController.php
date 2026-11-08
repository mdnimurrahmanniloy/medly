<?php

namespace App\Http\Controllers;

use App\Models\DoctorProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class DoctorVerificationController extends Controller
{
    // Doctor sign-up form.
    public function create()
    {
        return view('doctors.register');
    }

    // Create the doctor account with a pending profile.
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'license_number' => ['required', 'string', 'max:50', 'unique:doctor_profiles,license_number'],
        ]);

        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->role = 'doctor';
        $user->save();

        DoctorProfile::create([
            'user_id' => $user->id,
            'license_number' => $data['license_number'],
            'status' => 'pending',
        ]);

        Auth::login($user);

        return redirect()->route('doctor.status');
    }

    // A doctor checks the state of their own verification.
    public function status()
    {
        abort_unless(auth()->user()->role === 'doctor', 403);

        $profile = DoctorProfile::where('user_id', auth()->id())->firstOrFail();

        return view('doctors.status', compact('profile'));
    }

    // Admin: list of all doctors, pending first.
    public function index()
    {
        $this->requireAdmin();

        $profiles = DoctorProfile::with('user')
            ->orderByRaw("status = 'pending' desc")
            ->latest()
            ->get();

        return view('doctors.admin-index', compact('profiles'));
    }

    public function approve(DoctorProfile $profile)
    {
        $this->requireAdmin();

        $profile->update([
            'status' => 'approved',
            'rejection_reason' => null,
        ]);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor approved.');
    }

    public function reject(Request $request, DoctorProfile $profile)
    {
        $this->requireAdmin();

        $data = $request->validate([
            'rejection_reason' => ['required', 'string', 'max:255'],
        ]);

        $profile->update([
            'status' => 'rejected',
            'rejection_reason' => $data['rejection_reason'],
        ]);

        return redirect()->route('admin.doctors.index')->with('status', 'Doctor rejected.');
    }

    private function requireAdmin(): void
    {
        abort_unless(auth()->user()->role === 'admin', 403);
    }
}
