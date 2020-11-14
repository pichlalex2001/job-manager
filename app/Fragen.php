<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use \DateTimeInterface;

class Fragen extends Model
{
    use MultiTenantModelTrait;

    public $table = 'fragens';

    public static $searchable = [
        'question',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'question',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function questionAntwortens()
    {
        return $this->hasMany(Antworten::class, 'question_id', 'id');
    }

    public function questionsJobs()
    {
        return $this->belongsToMany(Job::class);
    }

    public function questionsBewerbers()
    {
        return $this->belongsToMany(Bewerber::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
