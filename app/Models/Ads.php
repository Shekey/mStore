<?php

namespace App\Models;

use App\Events\AdsCreated;
use App\Events\AdsDeleted;
use App\Events\AdsUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Ads extends Model
{
    use HasFactory;
    use Notifiable;

    protected $guarded = [];
    protected $table = 'reklame';

    protected $dispatchesEvents = [
        'created' => AdsCreated::class,
        'updated' => AdsUpdated::class,
        'deleted' => AdsDeleted::class,
    ];
}
