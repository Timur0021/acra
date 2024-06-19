<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Workers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'service_id',
        'salary',
        'birthday',
        'is_active',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
