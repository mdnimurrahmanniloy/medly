<?php

namespace App\Http\Controllers;

use App\Models\Allergy;
use App\Models\Condition;
use App\Models\FamilyMember;
use App\Models\HealthProfile;
use Illuminate\Http\Request;

class HealthProfileController extends Controller
{
    public function edit(FamilyMember $family)
    {
        $this->authorizeOwner($family);
        $family->load(['healthProfile', 'allergies', 'conditions']);

        return view('family.health', ['member' => $family]);
    }

    public function update(Request $request, FamilyMember $family)
    {
        $this->authorizeOwner($family);

        $data = $request->validate([
            'blood_group' => ['nullable', 'in:A+,A-,B+,B-,AB+,AB-,O+,O-'],
            'emergency_contact_name' => ['nullable', 'string', 'max:100'],
            'emergency_contact_phone' => ['nullable', 'string', 'max:30'],
        ]);

        HealthProfile::updateOrCreate(['family_member_id' => $family->id], $data);

        return redirect()->route('health.edit', $family)->with('status', 'Health profile saved.');
    }

    public function storeAllergy(Request $request, FamilyMember $family)
    {
        $this->authorizeOwner($family);
        $data = $request->validate(['name' => ['required', 'string', 'max:100']]);

        Allergy::create(['family_member_id' => $family->id, 'name' => $data['name']]);

        return redirect()->route('health.edit', $family)->with('status', 'Allergy added.');
    }

    public function destroyAllergy(Allergy $allergy)
    {
        abort_unless($allergy->familyMember->user_id === auth()->id(), 403);
        $memberId = $allergy->family_member_id;
        $allergy->delete();

        return redirect()->route('health.edit', $memberId)->with('status', 'Allergy removed.');
    }

    public function storeCondition(Request $request, FamilyMember $family)
    {
        $this->authorizeOwner($family);
        $data = $request->validate(['name' => ['required', 'string', 'max:100']]);

        Condition::create(['family_member_id' => $family->id, 'name' => $data['name']]);

        return redirect()->route('health.edit', $family)->with('status', 'Condition added.');
    }

    public function destroyCondition(Condition $condition)
    {
        abort_unless($condition->familyMember->user_id === auth()->id(), 403);
        $memberId = $condition->family_member_id;
        $condition->delete();

        return redirect()->route('health.edit', $memberId)->with('status', 'Condition removed.');
    }

    private function authorizeOwner(FamilyMember $member): void
    {
        abort_unless($member->user_id === auth()->id(), 403);
    }
}
