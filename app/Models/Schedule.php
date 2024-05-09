<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'work_schedules';
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'company_id',
        'start_time',
        'end_time',
    ];

    public function worker()
    {
        return $this->belongsTo('App\Models\User');
    }

}
