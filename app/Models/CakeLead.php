<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CakeLead extends Pivot
{
    use HasFactory;

    public function cake() {
        return $this->belongsTo(Cake::class);
    }

    public function lead() {
        return $this->belongsTo(Lead::class);
    }
}
