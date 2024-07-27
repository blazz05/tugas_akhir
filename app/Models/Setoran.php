<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Setoran extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $table = 'setoran';

    protected $fillable = [
        'tanggal',
        'waktu',
        'juz',
        'halaman',
        'mahasantri_id',
    ];

    /**
     * Get the options for activity logging.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnly(['tanggal', 'waktu', 'juz', 'halaman', 'mahasantri_id'])
            ->useLogName('setoran')
            ->setDescriptionForEvent(fn(string $eventName) => "Setoran has been {$eventName}");
    }
}
