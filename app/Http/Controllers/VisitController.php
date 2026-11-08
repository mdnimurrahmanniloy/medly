<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use App\Models\Visit;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    public function index()
    {
        $visits = Visit::whereHas('familyMember', function ($query) {
            $query->where('user_id', auth()->id());
        })
            ->with('familyMember')
            ->orderByDesc('visit_date')
            ->get();

        return view('visits.index', compact('visits'));
    }

    public function create()
    {
        return view('visits.create', ['members' => $this->members()]);
    }

    public function store(Request $request)
    {
        Visit::create($this->validated($request));

        return redirect()->route('visits.index')->with('status', 'Visit saved.');
    }

    public function edit(Visit $visit)
    {
        $this->authorizeOwner($visit);

        return view('visits.edit', [
            'visit' => $visit,
            'members' => $this->members(),
        ]);
    }

    public function update(Request $request, Visit $visit)
    {
        $this->authorizeOwner($visit);
        $visit->update($this->validated($request));

        return redirect()->route('visits.index')->with('status', 'Visit updated.');
    }

    public function destroy(Visit $visit)
    {
        $this->authorizeOwner($visit);
        $visit->delete();

        return redirect()->route('visits.index')->with('status', 'Visit deleted.');
    }

    // The logged-in user's own family members.
    private function members()
    {
        return FamilyMember::where('user_id', auth()->id())->orderBy('name')->get();
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'family_member_id' => ['required', 'integer'],
            'doctor_name' => ['required', 'string', 'max:100'],
            'visit_date' => ['required', 'date', 'before_or_equal:today'],
            'diagnosis' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string', 'max:2000'],
        ]);

        // The chosen member must belong to this user.
        abort_unless($this->members()->contains('id', $data['family_member_id']), 403);

        return $data;
    }

    private function authorizeOwner(Visit $visit): void
    {
        abort_unless($visit->familyMember->user_id === auth()->id(), 403);
    }
}
