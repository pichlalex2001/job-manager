<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
    public $sources = [
        [
            'model'      => '\App\Job',
            'date_field' => 'created_at',
            'field'      => 'job_nr',
            'prefix'     => 'Job',
            'suffix'     => 'wurde erstellt',
            'route'      => 'admin.jobs.edit',
        ],
        [
            'model'      => '\App\Bewerber',
            'date_field' => 'created_at',
            'field'      => 'name',
            'prefix'     => 'Bewerber',
            'suffix'     => 'wurde erstellt',
            'route'      => 'admin.bewerbers.edit',
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
