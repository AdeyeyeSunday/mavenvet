<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Syn extends Model
{
    use HasFactory;

    protected $connection = 'online_syn';
}
