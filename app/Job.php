<?php

namespace App;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Job extends Model
{
    use MultiTenantModelTrait, Auditable;

    public $table = 'jobs';

    const STATUS_SELECT = [
        '0' => 'Inaktiv',
        '1' => 'Aktiv',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static $searchable = [
        'job_nr',
        'jobtitle',
        'status',
        'anmerkungen',
        'milestone_1',
        'milestone_2',
        'milestone_3',
    ];

    protected $fillable = [
        'job_nr',
        'jobtitle',
        'status',
        'anmerkungen',
        'milestone_1',
        'milestone_2',
        'milestone_3',
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
        Job::observe(new \App\Observers\JobActionObserver);
    }

    public function jobBewerbers()
    {
        return $this->hasMany(Bewerber::class, 'job_id', 'id');
    }

    public function questions()
    {
        return $this->belongsToMany(Fragen::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
