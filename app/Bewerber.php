<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Bewerber extends Model
{
    use MultiTenantModelTrait, Auditable;

    public $table = 'bewerbers';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'name',
        'email',
        'tel',
        'status',
    ];

    const STATUS_SELECT = [
        'zusage'    => 'Zusage',
        'absage'    => 'Absage',
        'unbekannt' => 'Unbekannt',
    ];

    protected $fillable = [
        'name',
        'email',
        'tel',
        'job_id',
        'status',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
        Bewerber::observe(new \App\Observers\BewerberActionObserver);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function questions()
    {
        return $this->belongsToMany(Fragen::class);
    }

    public function answers()
    {
        return $this->belongsToMany(Antworten::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
