
<div>
    <div x-data @click="
        let targetTagName = $event.target.tagName.toLowerCase()
        if (['button', 'svg', 'path', 'a'].includes(targetTagName))  {
        return;
        }
        $refs.show_{{$idea->id}}.click()"
         class="idea-container cursor-pointer hover:shadow-md transition bg-white rounded-xl">
        <div class="flex">
            <div class="hidden lg:block border-r border-gray-100 px-5 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">{{$idea->votedUsersCount}}</div>
                    <div class="text-gray-500">Votes</div>
                </div>
                <div class=" mt-8">
                    <button
                        wire:click="vote"
                        class="@if($idea->isVoted) border-gray-400 bg-blue text-white @endif border-gray-200 hover:border-gray-400 w-20 hover:bg-blue transition duration-150 text-xxs hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">
                        {{$idea->isVoted ? 'Voted' : 'Vote'}}
                    </button>
                </div>
            </div>
            <div class="lg:ml-4 flex flex-col lg:flex-row px-5 py-4 lg:py-8">
                <a href="" class="flex-none">
                    <img src="{{$idea->user->avatar()}}" class="w-14 h-14 rounded-xl mr-4" alt="">
                </a>
                <div>
                    <h4 class="mb-4 font-semibold text-xl">
                        <a x-ref="show_{{$idea->id}}" href="{{route('ideas.show', $idea->slug)}}">{{$idea->title}}</a></h4>
                    <p class="line-clamp-3">
                        {{$idea->description}}
                    </p>
                </div>
            </div>
        </div>

        <div class="lg:flex-row lg:flex lg:justify-between  px-5 lg:py-8 py-4">
            <div class="flex items-center space-x-1 lg:space-x-6">
                <span class="text-gray-400">{{$idea->created_at->diffForHumans()}}</span>
                <span class="text-2xl text-gray-300">&bull;</span>
                <span class="text-gray-400">{{$idea->category->name}}</span>
                <span class="text-2xl text-gray-300">&bull;</span>
                <span class="font-semibold">3 Comments</span>
            </div>
            <div class="flex space-x-6" x-data="{showDialog:false}">
                <button class="px-6 py-2 font-semibold uppercase rounded-xl {{$idea->status->class}}">{{$idea->status->name}}</button>
                <button @click="showDialog = !showDialog"
                        class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                    <ul @click.outside.window="showDialog = false" x-show="showDialog" x-transition class="space-y-4 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Mark as spam</a></li>
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Delete post</a></li>
                    </ul>
                </button>
            </div>
            <div class="lg:hidden flex justify-start items-center border-r border-gray-100 py-8">
                <div class="text-center">
                    <div class="font-semibold text-2xl">{{$idea->votedUsersCount}}</div>
                    <div class="text-gray-500">Votes</div>
                </div>
                <div>
                    <button
                        wire:click="vote"
                        class="@if($idea->isVoted) border-gray-400 bg-blue text-white @endif border-gray-200 hover:border-gray-400 w-20 hover:bg-blue transition duration-150 text-xxs hover:text-white px-4 text-md py-2 rounded-xl bg-gray-300 uppercase">
                        {{$idea->isVoted ? 'Voted' : 'Vote'}}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
