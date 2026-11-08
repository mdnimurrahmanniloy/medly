<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\FamilyMember;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $all = Appointment::whereHas('familyMember', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with('familyMember')
            ->orderBy('appointment_at')
            ->get();

        // Split into future and past appointments for the page.
        [$upcoming, $past] = $all->partition(fn ($a) => $a->appointment_at->isFuture());

        return view('appointments.index', [
            'upcoming' => $upcoming,
            'past' => $past->reverse(),
        ]);
    }

    public function create()
    {
        return view('appointments.create', ['members' => $this->members()]);
    }

    public function store(Request $request)
    {
        Appointment::create($this->validated($request));

        return redirect()->route('appointments.index')->with('status', 'Appointment saved.');
    }

    public function edit(Appointment $appointment)
    {
        $this->authorizeOwner($appointment);

        return view('appointments.edit', [
            'appointment' => $appointment,
            'members' => $this->members(),
        ]);
    }

    public function update(Request $request, Appointment $appointment)
    {
        $this->authorizeOwner($appointment);
        $appointment->update($this->validated($request));

        return redirect()->route('appointments.index')->with('status', 'Appointment updated.');
    }

    public function destroy(Appointment $appointment)
    {
        $this->authorizeOwner($appointment);
        $appointment->delete();

        return redirect()->route('appointments.index')->with('status', 'Appointment deleted.');
    }

    private function members()
    {
        return FamilyMember::where('user_id', auth()->id())->orderBy('name')->get();
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'family_member_id' => ['required', 'integer'],
            'title' => ['required', 'string', 'max:150'],
            'appointment_at' => ['required', 'date'],
            'location' => ['nullable', 'string', 'max:150'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        abort_unless($this->members()->contains('id', $data['family_member_id']), 403);

        return $data;
    }

    private function authorizeOwner(Appointment $appointment): void
    {
        abort_unless($appointment->familyMember->user_id === auth()->id(), 403);
    }
}
