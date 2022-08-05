<div x-data="{showDialog : false}" class="relative">
    <button class="relative" @click.prevent="showDialog = !showDialog
                                            if(showDialog) {
                                            Livewire.emit('getNotification')
                                            }
                        ">
        <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
        </svg>
        <div class="absolute top-0 -right-1 rounded-full bg-red text-white w-5 h-5">{{$notificationCount}}</div>
    </button>
    <ul @click.outside.window="showDialog = false" x-show="showDialog" x-cloak x-transition
        class="top-9 -right-4 absolute w-70 md:w-96 max-h-128 bg-white shadow-lg rounded-xl py-3 z-20 overflow-y-auto">
        @foreach($notifications as $notification)
            <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
                <a href="{{$notification->data['linkToIdea']}}" class="px-5 inline-block flex space-x-4">
                    <img class="rounded-full w-12 h-12" src="{{$notification->data['commenterAvatar']}}" alt="picture">
                    <div class="flex flex-col space-y-3">
                        <div>
                            {!! $notification->data['message'] !!}
                        </div>
                        <span class="text-gray-400 text-xs">{{$notification->created_at->diffForHumans()}}</span>
                    </div>
                </a>
            </li>
        @endforeach
        <li class="text-left hover:bg-gray-100 transition duration-150 py-2">
            <button class="w-full text-center px-2 py-3">Mark all as read</button>
        </li>
    </ul>

</div>
