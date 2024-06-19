<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_day_from',
        'work_day_to',
        'worker_id',
    ];

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Workers::class);
    }
}
