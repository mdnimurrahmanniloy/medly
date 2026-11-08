<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    protected $fillable = [
        'family_member_id',
        'doctor_name',
        'visit_date',
        'diagnosis',
        'notes',
    ];

    protected $casts = [
        'visit_date' => 'date',
    ];

    public function familyMember(): BelongsTo
    {
        return $this->belongsTo(FamilyMember::class);
    }
}
