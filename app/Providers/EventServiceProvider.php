<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\BookingHistory;
use App\Models\Employee;
use App\Models\Feature;
use App\Models\FileManager;
use App\Models\Guest;
use App\Models\Room;
use App\Models\RoomCategory;
use App\Models\Tag;
use App\Models\User;
use App\Observers\BookingHistoryObserver;
use App\Observers\BookingObserver;
use App\Observers\FeatureObserver;
use App\Observers\FileManagerObserver;
use App\Observers\FilteredRoomObserver;
use App\Observers\GuestObserver;
use App\Observers\RoomCategoriesObserver;
use App\Observers\StaffObserver;
use App\Observers\TagObserver;
use App\Observers\UsersObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        User::observe(UsersObserver::class);
        Employee::observe(StaffObserver::class);
        RoomCategory::observe(RoomCategoriesObserver::class);
        Tag::observe(TagObserver::class);
        Feature::observe(FeatureObserver::class);
        FileManager::observe(FileManagerObserver::class);
        Guest::observe(GuestObserver::class);
        Room::observe(FilteredRoomObserver::class);
        Booking::observe(BookingObserver::class);
        BookingHistory::observe(BookingHistoryObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
