<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class leaveFile extends Model
{
    
    use HasFactory;
    protected $table = 'leave_files';
    protected $primaryKey = 'id';
    protected $fillable = [
        'leave_id',
        'image'
    ];

    public function leave(){
        return $this->belongsTo(Leave::class);
    }

   
}
