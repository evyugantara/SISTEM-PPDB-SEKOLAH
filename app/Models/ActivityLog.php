<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'role', 'activity', 'ip_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public static function log($activity)
    {
        if (auth()->check()) {
            self::create([
                'user_id' => auth()->id(),
                'role' => auth()->user()->role,
                'activity' => $activity,
                'ip_address' => request()->ip(),
            ]);
        }
    }
}


