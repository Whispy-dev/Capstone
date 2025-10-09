<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'start',
        'end',
        'location',
        'className'
    ];

    protected $casts = [
        'start' => 'datetime',
        'end' => 'datetime',
    ];
}