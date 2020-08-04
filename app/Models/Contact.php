<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Contact extends Model
{
    use SoftDeletes;

    public $table = 'contacts';

    public static $searchable = [
        'branch',
    ];

    const ACTIVE_RADIO = [
        '1' => 'active',
        '0' => 'inactive',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'organizer_id',
        'branch',
        'mobile',
        'email',
        'whatsapp',
        'website',
        'address',
        'active',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function organizer()
    {
        return $this->belongsTo(Organizer::class, 'organizer_id');
    }
}
