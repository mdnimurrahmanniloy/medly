<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Appointment extends Model
{
    protected $fillable = [
        'family_member_id',
        'title',
        'appointment_at',
        'location',
        'notes',
    ];

    protected $casts = [
        'appointment_at' => 'datetime',
    ];

    public function familyMember(): BelongsTo
    {
        return $this->belongsTo(FamilyMember::class);
    }
}
