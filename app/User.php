<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\UserRegistered;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\Traits\CausesActivity;
use App\Builders\UserBuilder;
use App\Collections\UserCollection;
use Silber\Bouncer\Database\HasRolesAndAbilities;
use Illuminate\Foundation\Auth\Access\Authorizable;

use \stdclass;

class User extends Authenticatable
{
    use Authorizable, HasApiTokens, Notifiable, LogsActivity, CausesActivity, HasRolesAndAbilities;

    public function receivesBroadcastNotificationsOn()
    {
        return 'users.' . $this->id;
    }

    public function newEloquentBuilder($builder)
    {
        return new UserBuilder($builder);
    }

    public function newCollection(array $models = [])
    {
        return new UserCollection($models);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'last_name', 'first_name', 'middle_name', 'official_photo', 'birth_date', 'pd_email', 'pd_gmail', 'contact_numbers', 'employment_date', 'positions', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'contact_numbers' => 'array',
        'positions' => 'array',
    ];

    public function getCurrentScoreAttribute()
    {
        $score = 0;
        foreach ($this->team_projects as $team_project) {
            $score += $this->getProjectScore($team_project);
        }
        return $score;
        // return $this->team_projects;
    }

    public function getTotalScoreAttribute()
    {
        return 10;
    }

    public function getProjectScore($team_project)
    {
        $score_percentage = $team_project->score_percentage;
        $project_percentage = $team_project->project->score;
        return $project_percentage * $score_percentage;
    }

    public function getScoresAttribute()
    {
        $scores = new stdClass;
        $current_score = 0;
        $total_score = 0;
        foreach ($this->team_projects as $team_project) {
            if ($team_project->project->project_status != 'Closed') {
                $current_score += $this->getProjectScore($team_project);
            } else {
                $total_score += $this->getProjectScore($team_project);
            }
        }
        $scores->current_score = $current_score;
        $scores->total_score = $total_score;
        return $scores;
    }
    public function getFullNameAttribute()
    {
        return $this->attributes["last_name"] . ", " . $this->attributes["first_name"];
    }
    public function accounts()
    {
        return $this->hasMany("App/Account");
    }

    public function vendors()
    {
        return $this->hasMany("App/Vendor");
    }

    public function mandates()
    {
        return $this->hasMany("App/Mandate");
    }

    public function budgetAllocations()
    {
        return $this->hasMany("App/BudgetAllocation");
    }

    public function core_team_projects()
    {
        return $this->belongsToMany("App\Project", 'project_core_employees');
    }
    public function team_projects()
    {
        return $this->hasMany("App\ProjectCoreEmployee")->with('project');
    }
}
