<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HealthProfile extends Model
{
    protected $fillable = [
        'family_member_id',
        'blood_group',
        'emergency_contact_name',
        'emergency_contact_phone',
    ];

    public function familyMember(): BelongsTo
    {
        return $this->belongsTo(FamilyMember::class);
    }
}
