<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resep extends Model
{
    protected $table = 'resep';

    protected $fillable = [
        'pemeriksaan_id',
        'tanggal_resep',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_resep' => 'date',
        ];
    }

    public function pemeriksaan(): BelongsTo
    {
        return $this->belongsTo(Pemeriksaan::class, 'pemeriksaan_id');
    }

    public function details(): HasMany
    {
        return $this->hasMany(ResepDetail::class, 'resep_id');
    }
}