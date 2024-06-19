<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Vacation extends Model
{
    use HasFactory;

    protected $fillable = [
        'vacation_day_from',
        'vacation_day_to',
        'worker_id',
    ];

    public function worker(): BelongsTo
    {
        return $this->belongsTo(Workers::class);
    }

    public function isActive()
    {
        $today = Carbon::now()->toDateString();
        return $today >= $this->vacation_day_from && $today <= $this->vacation_day_to;
    }

    public function isEnded()
    {
        $today = Carbon::now()->toDateString();
        return $today > $this->vacation_day_to;
    }
}
