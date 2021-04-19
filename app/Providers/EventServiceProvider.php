<?php

namespace App\Providers;
use App\Events\Customer\GuarantorRegistration;
use App\Listeners\Customer\NotifyGuarantor;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CustomerRegistration::class => [
            SendCustomerVerificationEmail::class
        ],
        GuarantorRegistration::class => [
            NotifyGuarantor::class
        ],
        'App\Events\AssignedManager' => [
            'App\Events\NotifyLoanManager'
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
