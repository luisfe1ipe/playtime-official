<div>

    @switch($notification)
        @case($notification->type === 'user-registered-vacancy')
            <x-notifications.user-registered-vacancy-notification :notification="$notification" />
        @break

        @case($notification->type === 'user-accept-or-refuse-vacancy')
            <x-notifications.user-accept-vacancy-notification :notification="$notification" />
        @break

        @case($notification->type === 'friend-notification')
            <x-notifications.friend-notification :notification="$notification" />
        @break

        @default
    @endswitch
</div>
