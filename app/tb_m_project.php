<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tb_m_project extends Model
{
    protected $fillable = [
        'project_id','project_name', 'client_id', 'project_start','project_end','project_status'
    ];
}
