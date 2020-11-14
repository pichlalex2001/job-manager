<?php

namespace App\Observers;

use App\Bewerber;
use App\Notifications\DataChangeEmailNotification;
use Illuminate\Support\Facades\Notification;

class BewerberActionObserver
{
    public function created(Bewerber $model)
    {
        $data  = ['action' => 'created', 'model_name' => 'Bewerber'];
        $users = \App\User::whereHas('roles', function ($q) {
            return $q->where('title', 'Admin');
        })->get();
        Notification::send($users, new DataChangeEmailNotification($data));
    }
}
