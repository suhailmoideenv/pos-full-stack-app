<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Tables_has_Reservation_Times extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'tables_has_reservation_times';
    protected $guarded = [];

}
