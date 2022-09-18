<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  use HasFactory;

  protected $fillable = [
    'name',
  ];

  public static function akademik()
  {
    return Role::where('name', 'Akademik')->first();
  }

  public static function ketua()
  {
    return Role::where('name', 'Ketua')->first();
  }

  public static function staff()
  {
    return Role::where('name', 'Staff')->first();
  }
}
