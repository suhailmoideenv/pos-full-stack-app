<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order_Items_has_Add_Ons extends Authenticatable
{
    use HasFactory;
    use Notifiable;

    protected $table = 'order_items_has_add_ons';
    protected $guarded = [];

}
