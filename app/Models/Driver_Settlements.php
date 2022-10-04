<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Driver_Settlements extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'driver_settlements';
    protected $guarded = [];

}
