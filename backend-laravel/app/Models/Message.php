<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'role',
        'content',
        'status',
        'created_at',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
