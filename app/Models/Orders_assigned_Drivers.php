<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Orders_assigned_Drivers extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'orders_assigned_drivers';
    protected $guarded = [];

}
