<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncidentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'incident_categories';

    protected $fillable = [
        'name',
        'description',
        'sla_hours',
        'sla_type',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'sla_hours' => 'integer',
    ];

    /**
     * Relaciones
     */
    public function incidents()
    {
        return $this->hasMany(Incident::class);
    }

    public function communes()
    {
        return $this->belongsToMany(Commune::class, 'category_commune_sla')
                    ->withPivot('sla_hours', 'sla_type')
                    ->withTimestamps();
    }

    /**
     * Scopes
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function scopeWithSlaType($query, $type)
    {
        return $query->where('sla_type', $type);
    }

    /**
     * Métodos útiles
     */
    public function getSlaLabelAttribute()
    {
        return ucfirst($this->sla_type) . ' (' . $this->sla_hours . 'h)';
    }

    public function getColorCodeAttribute()
    {
        return match ($this->sla_type) {
            'respuesta'    => '#3498db',
            'resolución'   => '#27ae60',
            'escalamiento' => '#e74c3c',
            default        => '#95a5a6',
        };
    }

    public function getIsCriticalAttribute()
    {
        return $this->sla_hours <= 12;
    }
}