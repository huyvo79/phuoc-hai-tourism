<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;
    
    // Nếu bảng trong database tên là 'visitors' thì không cần dòng này
    // protected $table = 'visitors'; 

    protected $fillable = ['ip_address', 'user_agent', 'visit_date'];
}