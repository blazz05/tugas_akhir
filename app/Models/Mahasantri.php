<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Mahasantri extends Model
{
    use LogsActivity;
    use HasFactory;

    protected $table = 'mahasantri';

    protected $fillable = [
        'nim',
        'nama',
        'asal',
        'kelas',
        'tahun_ajaran',
        'lulus',
        'keterangan',
    ];

    /**
     * Get the options for activity logging.
     */
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logUnguarded()
            ->logOnly(['nim', 'nama', 'asal', 'kelas', 'tahun_ajaran', 'lulus', 'keterangan'])
            ->useLogName('mahasantri')
            ->setDescriptionForEvent(fn(string $eventName) => "Mahasantri has been {$eventName}");
    }
}
