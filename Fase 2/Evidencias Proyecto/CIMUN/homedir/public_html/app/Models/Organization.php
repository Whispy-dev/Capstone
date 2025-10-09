<?php
namespace Modules\Organizations\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'logo_url',
        'created_by',
        'updated_by',
    ];

    // Relationships
    public function users()
    {
        return $this->hasMany(\App\Models\User::class);
    }

    public function incidents()
    {
        return $this->hasMany(\Modules\Incidents\Models\Incident::class);
    }
}