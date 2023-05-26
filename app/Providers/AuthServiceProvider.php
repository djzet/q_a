<?php

namespace App\Providers;

use App\Models\Answer;
use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::before(function ($user, $ability){
            if ($user->role_id == 1){
                return true;
            }
        });

        Gate::define('update-user-question', function (User $user, Question $question){
            if($user->id === $question->user_id){
                return Response::allow();
            }
            return Response::deny('You cannot edit someone else is question!');
        });
        Gate::define('delete-user-question', function (User $user, Question $question){
            if($user->id === $question->user_id){
                return Response::allow();
            }
            return Response::deny('You cannot edit someone else is question!');
        });
        Gate::define('update-user-answer', function (User $user, Answer $answer){
            if($user->id === $answer->user_id){
                return Response::allow();
            }
            return Response::deny('You cannot edit someone else is question!');
        });
        Gate::define('delete-user-answer', function (User $user, Answer $answer){
            if($user->id === $answer->user_id){
                return Response::allow();
            }
            return Response::deny('You cannot edit someone else is question!');
        });
    }
}
