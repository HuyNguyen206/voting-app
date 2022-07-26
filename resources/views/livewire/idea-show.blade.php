<div>
    <div class="idea-container cursor-pointer hover:shadow-md transition bg-white rounded-xl">
        <div class="flex">
            {{--            <div class="border-r border-gray-100 px-5 py-8">--}}
            {{--                <div class="text-center">--}}
            {{--                    <div class="font-semibold text-2xl">12</div>--}}
            {{--                    <div class="text-gray-500">Votes</div>--}}
            {{--                </div>--}}
            {{--                <div class=" mt-8">--}}
            {{--                    <button class="border-gray-200 hover:border-gray-400 w-20 hover:bg-blue transition duration-150 text-xxs hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">--}}
            {{--                        Vote--}}
            {{--                    </button>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            <div class="ml-4 flex px-5 py-8">
                <a href="" class="flex-none">
                    <img src="{{$idea->user->avatar()}}" class="w-14 h-14 rounded-xl mr-4" alt="">
                </a>
                <div>
                    <h4 class="mb-4 font-semibold text-xl">
                        <a href="">{{$idea->title}}</a></h4>
                    <div class="line-clamp-3">
                        @admin
                        @if($idea->spam_reports)
                            <p class="text-red mb-2">Spam reports: {{$idea->spam_reports}}</p>
                        @endif
                        @endadmin
                        {{$idea->description}}
                    </div>
                </div>

            </div>

        </div>

        <div class="lg:flex-row lg:justify-between flex flex-col lg:items-center  px-5 py-8">
            <div class="flex items-center text-xs space-x-4 lg:ml-4 flex px-5 py-8">
                <span class="font-semibold">{{$idea->user->name}}</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="text-gray-400">{{$idea->created_at->diffForHumans()}}</span>
                <span class="text-2xl text-gray-300">•</span>
                <span class="text-gray-400">{{$idea->category->name}}</span>
                <span class="text-2xl text-gray-300">•</span>
                <span
                    class="font-semibold">{{$idea->comments()->count()}} {{Str::plural('comment', $idea->comments()->count())}} </span>
            </div>
            <div class="flex flex-col lg:flex-row " x-data="{showDialog:false}">
                <div class="lg:flex-row flex space-x-6">
                    <button
                        class="h-14 px-6 py-2 font-semibold uppercase rounded-xl status-idea-{{Str::kebab($idea->status->name)}}">{{$idea->status->name}}</button>
                    <button @click="showDialog = !showDialog"
                            class="h-14 relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                        <ul @click.outside.window="showDialog = false" x-show="showDialog" x-cloak x-transition
                            class="top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                            @can('markAsSpam', $idea)
                                <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a
                                        href="" class="px-5 font-bold inline-block"
                                        @click.prevent="$dispatch('custom-show-mark-spam-idea')">Mark as spam</a></li>
                            @endcan
                            @can('markAsNotSpam', $idea)
                                @if($idea->spam_reports)
                                    <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2">
                                        <a href="" class="px-5 font-bold inline-block"
                                           @click.prevent="$dispatch('custom-show-mark-not-spam-idea')">Mark as not
                                            spam</a></li>
                                @endif
                            @endcan
                            @can('delete', $idea)
                                <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a
                                        href="" class="px-5 font-bold inline-block"
                                        @click.prevent="$dispatch('custom-show-delete-idea')">Delete idea</a></li>
                            @endcan
                            @can('update', $idea)
                                <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a
                                        href="" class="px-5 font-bold inline-block"
                                        @click.prevent="$dispatch('custom-show-edit-idea')">Edit idea</a></li>
                            @endcan
                        </ul>
                    </button>
                </div>
                <div class="lg:hidden flex items-center border-r border-gray-100 px-5 py-8">
                    <div class="text-center mr-2">
                        <div class="font-semibold text-2xl">{{$idea->votedUsers()->count()}}</div>
                        <div class="{{$isVoted ? 'text-blue' : 'text-gray-500'}} ">Votes</div>
                    </div>
                    <div>
                        <button
                            wire:click="vote"
                            class="@if($isVoted) border-gray-400 bg-blue text-white @else bg-gray-300 @endif px-8 h-10 border-gray-200 hover:border-gray-400 hover:bg-blue transition duration-150 hover:text-white px-4 text-md py-2 rounded-xl uppercase">
                            {{$isVoted ? 'Voted' : 'Vote'}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-between">
        <div class="flex flex-col lg:flex-row justify-start items-center">
            <livewire:add-comment :idea="$idea"/>
            @admin
            <livewire:set-status :idea="$idea"/>
            @endadmin
        </div>
        <div class="hidden lg:flex justify-end items-center border-r border-gray-100 px-5 py-8">
            <div class="text-center mr-2">
                <div class="font-semibold text-2xl">{{$idea->votedUsers()->count()}}</div>
                <div class="{{$isVoted ? 'text-blue' : 'text-gray-500'}}">Votes</div>
            </div>
            <div>
                <button
                    wire:click="vote"
                    class="@if($isVoted) border-gray-400 bg-blue text-white @else bg-gray-300 @endif px-8 h-10 border-gray-200 hover:border-gray-400 hover:bg-blue transition duration-150 hover:text-white px-4 text-md py-2 rounded-xl uppercase">
                    {{$isVoted ? 'Voted' : 'Vote'}}
                </button>
            </div>
        </div>
    </div>
</div>
