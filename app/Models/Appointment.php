<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

    protected $fillable = [
        'user_id',
        'pet_id',
        'appointment_time',
        'reason'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Se necessário, adicione também a relação com a model Pet
    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }
}

