<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\\App\\Models\\Event',
            'date_field' => 'start_at',
            'field'      => 'title',
            'prefix'     => '',
            'suffix'     => 'start',
            'route'      => 'admin.events.edit',
        ],
        [
            'model'      => '\\App\\Models\\Event',
            'date_field' => 'end_at',
            'field'      => 'title',
            'prefix'     => '',
            'suffix'     => 'end',
            'route'      => 'admin.events.edit',
        ],
        [
            'model'      => '\\App\\Models\\Schedule',
            'date_field' => 'day',
            'field'      => 'title',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.schedules.edit',
        ],
    ];

    public function index()
    {
        $events = [];

        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . " " . $model->{$source['field']}
                        . " " . $source['suffix']),
                    'start' => $crudFieldValue,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        return view('admin.calendar.calendar', compact('events'));
    }
}
