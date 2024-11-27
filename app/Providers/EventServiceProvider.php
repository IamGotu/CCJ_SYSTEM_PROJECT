<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        \App\Events\StudentImported::class => [
            \App\Listeners\SyncDerogatoryRecords::class,
        ],
        \App\Events\StudentUpdated::class => [
            \App\Listeners\UpdateRelatedModules::class,
        ],   
    ];

    public function boot()
    {
        parent::boot();
    }
}