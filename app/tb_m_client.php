<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_m_client extends Model
{
    protected $fillable = [
        'client_name', 'client_address'
    ];
}
