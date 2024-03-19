<div>

  @switch($notification)
  @case($notification->type === 'user-registered-vacancy')
  <x-notifications.user-registered-vacancy-notification :notification="$notification" />
  @break
  @case($notification->type === 'user-accept-vacancy')
  <x-notifications.user-accept-vacancy-notification :notification="$notification" />
  @break
  @default

  @endswitch
</div>