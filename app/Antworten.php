<?php

namespace App;

use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Antworten extends Model
{
    use SoftDeletes, MultiTenantModelTrait;

    public $table = 'antwortens';

    public static $searchable = [
        'answer',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'created_at',
        'question_id',
        'answer',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function answersBewerbers()
    {
        return $this->belongsToMany(Bewerber::class);
    }

    public function question()
    {
        return $this->belongsTo(Fragen::class, 'question_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
