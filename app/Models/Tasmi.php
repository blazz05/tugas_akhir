<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Tasmi extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $table = 'tasmi';

    protected $fillable = [
        'tanggal',
        'waktu',
        'keterangan',
        'setoran_id',
        'setoran_mahasantri_id',
    ];

    /**
     * Get the options for activity logging.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnly(['tanggal', 'waktu', 'keterangan', 'setoran_id', 'setoran_mahasantri_id'])
            ->useLogName('tasmi')
            ->setDescriptionForEvent(fn(string $eventName) => "Tasmi has been {$eventName}");
    }
}
