<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = "events";
    protected $primaryKey = "id";
    protected $guarded = [];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'type',
        'price',
        'date',
        'location',
    ];

    /**
     * Relationships
     */
    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
