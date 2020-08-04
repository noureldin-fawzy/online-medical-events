<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;
use \DateTimeInterface;

class Event extends Model implements HasMedia
{
    use SoftDeletes, HasMediaTrait, Auditable;

    public $table = 'events';

    public static $searchable = [
        'title',
    ];

    const ACTIVE_RADIO = [
        '1' => 'active',
        '0' => 'inactive',
    ];

    protected $dates = [
        'start_at',
        'end_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'specialty_id',
        'title',
        'description',
        'start_at',
        'end_at',
        'link',
        'notification',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function eventTopics()
    {
        return $this->hasMany(Topic::class, 'event_id', 'id');
    }

    public function eventSpeakers()
    {
        return $this->hasMany(Speaker::class, 'event_id', 'id');
    }

    public function eventExhibitions()
    {
        return $this->hasMany(Exhibition::class, 'event_id', 'id');
    }

    public function eventEventAttendees()
    {
        return $this->hasMany(EventAttendee::class, 'event_id', 'id');
    }

    public function eventSchedules()
    {
        return $this->hasMany(Schedule::class, 'event_id', 'id');
    }

    public function eventBoards()
    {
        return $this->belongsToMany(Board::class);
    }

    public function eventOrganizers()
    {
        return $this->belongsToMany(Organizer::class);
    }

    public function eventSponsors()
    {
        return $this->belongsToMany(Sponsor::class);
    }

    public function specialty()
    {
        return $this->belongsTo(Specialty::class, 'specialty_id');
    }

    public function getStartAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setStartAtAttribute($value)
    {
        $this->attributes['start_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getEndAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEndAtAttribute($value)
    {
        $this->attributes['end_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }
}
