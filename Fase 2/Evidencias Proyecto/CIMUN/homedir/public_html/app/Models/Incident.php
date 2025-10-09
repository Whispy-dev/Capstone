<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Incident extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'title',
    'description',
    'assigned_id',
    'priority',
    'status',
    'category_id',
    'municipality_id',
    ];


    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Los valores posibles para status
     */
    const STATUS_OPEN = 'open';
    const STATUS_PENDING = 'pending';
    const STATUS_CLOSED = 'closed';

    /**
     * Los valores posibles para priority
     */
    const PRIORITY_LOW = 'low';
    const PRIORITY_MEDIUM = 'medium';
    const PRIORITY_HIGH = 'high';

    /**
     * Relación con el usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con los comentarios
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Scope para incidencias abiertas
     */
    public function scopeOpen($query)
    {
        return $query->where('status', self::STATUS_OPEN);
    }

    /**
     * Scope para incidencias pendientes
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope para incidencias cerradas
     */
    public function scopeClosed($query)
    {
        return $query->where('status', self::STATUS_CLOSED);
    }

    /**
     * Scope para alta prioridad
     */
    public function scopeHighPriority($query)
    {
        return $query->where('priority', self::PRIORITY_HIGH);
    }

    /**
     * Scope para media prioridad
     */
    public function scopeMediumPriority($query)
    {
        return $query->where('priority', self::PRIORITY_MEDIUM);
    }

    /**
     * Scope para baja prioridad
     */
    public function scopeLowPriority($query)
    {
        return $query->where('priority', self::PRIORITY_LOW);
    }

    /**
     * Accessor para obtener el estado formateado
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_OPEN => '🔵 Abierto',
            self::STATUS_PENDING => '🟡 En Proceso',
            self::STATUS_CLOSED => '⚫ Cerrado'
        ];

        return $labels[$this->status] ?? ucfirst($this->status);
    }

    /**
     * Accessor para obtener la prioridad formateada
     */
    public function getPriorityLabelAttribute()
    {
        $labels = [
            self::PRIORITY_HIGH => '🔴 Alta',
            self::PRIORITY_MEDIUM => '🟡 Media',
            self::PRIORITY_LOW => '🟢 Baja'
        ];

        return $labels[$this->priority] ?? ucfirst($this->priority);
    }

    /**
     * Accessor para obtener la clase CSS del estado
     */
    public function getStatusClassAttribute()
    {
        $classes = [
            self::STATUS_OPEN => 'status-open',
            self::STATUS_PENDING => 'status-pending',
            self::STATUS_CLOSED => 'status-closed'
        ];

        return $classes[$this->status] ?? 'status-default';
    }

    /**
     * Accessor para obtener la clase CSS de la prioridad
     */
    public function getPriorityClassAttribute()
    {
        $classes = [
            self::PRIORITY_HIGH => 'priority-high',
            self::PRIORITY_MEDIUM => 'priority-medium',
            self::PRIORITY_LOW => 'priority-low'
        ];

        return $classes[$this->priority] ?? 'priority-default';
    }

    /**
     * Obtener el conteo de comentarios
     */
    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    /**
     * Verificar si tiene comentarios
     */
    public function hasComments()
    {
        return $this->comments()->exists();
    }

    /**
     * Obtener el último comentario
     */
    public function getLastCommentAttribute()
    {
        return $this->comments()->latest()->first();
    }
    public function documents()
    {
        return $this->hasManyThrough(
            Document::class,  // Modelo final
            Comment::class,   // Modelo intermedio
            'incident_id',    // FK en Comment
            'comment_id',     // FK en Document
            'id',             // PK en Incident
            'id'              // PK en Comment
        );
    }
    public function category(): BelongsTo
    {
        return $this->belongsTo(IncidentCategory::class, 'category_id');
    }
    
    public function assigned()
    {
        return $this->belongsTo(User::class, 'assigned_id');
    }

}