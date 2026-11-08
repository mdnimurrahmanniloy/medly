<?php

namespace App\Http\Controllers;

use App\Models\FamilyMember;
use Illuminate\Http\Request;

class FamilyMemberController extends Controller
{
    public function index()
    {
        $members = FamilyMember::where('user_id', auth()->id())
            ->orderBy('name')
            ->get();

        return view('family.index', compact('members'));
    }

    public function create()
    {
        return view('family.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $data['user_id'] = auth()->id();

        FamilyMember::create($data);

        return redirect()->route('family.index')->with('status', 'Family member added.');
    }

    public function show(FamilyMember $family)
    {
        $this->authorizeOwner($family);
        $family->load(['healthProfile', 'allergies', 'conditions']);

        return view('family.show', ['member' => $family]);
    }

    public function edit(FamilyMember $family)
    {
        $this->authorizeOwner($family);

        return view('family.edit', ['member' => $family]);
    }

    public function update(Request $request, FamilyMember $family)
    {
        $this->authorizeOwner($family);
        $family->update($this->validated($request));

        return redirect()->route('family.index')->with('status', 'Family member updated.');
    }

    public function destroy(FamilyMember $family)
    {
        $this->authorizeOwner($family);
        $family->delete();

        return redirect()->route('family.index')->with('status', 'Family member removed.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'relationship' => ['required', 'string', 'max:50'],
            'date_of_birth' => ['required', 'date', 'before_or_equal:today'],
        ]);
    }

    // A user may only touch their own family members.
    private function authorizeOwner(FamilyMember $member): void
    {
        abort_unless($member->user_id === auth()->id(), 403);
    }
}
