<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Condition extends Model
{
    protected $fillable = ['family_member_id', 'name'];

    public function familyMember(): BelongsTo
    {
        return $this->belongsTo(FamilyMember::class);
    }
}
