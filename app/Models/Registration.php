<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    // Ganti 'id' dengan 'registrations', nama tabel yang sesuai
    protected $table = 'registrations';

    protected $primaryKey = "id"; // Pastikan primary key-nya 'id'

    protected $fillable = [
        'user_id',
        'event_id',
        'payment_status',
        'payment_proof',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Event
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}