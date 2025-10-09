<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    protected $fillable = [
        'incident_id',
        'comment_id',
        'name',
        'type',
        'path'
    ];

    /**
     * Relación con Incident
     */
    public function incident(): BelongsTo
    {
        return $this->belongsTo(Incident::class);
    }

    /**
     * Relación con Comment
     */
    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    /**
     * Accessor para obtener la URL completa del archivo
     */
    public function getFullPathAttribute(): string
    {
        return Storage::url($this->path);
    }

    /**
     * Accessor para obtener el tamaño formateado
     */
    public function getFormattedSizeAttribute(): string
    {
        // Si no tienes el campo size, puedes intentar obtenerlo del archivo
        try {
            $bytes = Storage::size('public/' . $this->path);
            $units = ['B', 'KB', 'MB', 'GB'];
            $i = 0;
            while ($bytes >= 1024 && $i < 3) {
                $bytes /= 1024;
                $i++;
            }
            return round($bytes, 2) . ' ' . $units[$i];
        } catch (\Exception $e) {
            return 'Desconocido';
        }
    }
}