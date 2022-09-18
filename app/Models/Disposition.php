<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'reason',
        'created_by_user_id',
        'addressed_to_user_id',
        'letter_id',
        'description',
    ];

    public function letter()
    {
        return $this->belongsTo(Letter::class, 'letter_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    public function addressedToUser()
    {
        return $this->belongsTo(User::class, 'addressed_to_user_id');
    }
}
