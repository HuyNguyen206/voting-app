<div class="comment relative @if($comment->user->isAdmin()) is-admin border-blue border-2 rounded-xl @endif">
    <div class="flex">
        <div class="ml-4 flex px-5 py-8">
            <a href="" class="flex-none">
                <img src="{{$comment->user->avatar()}}" class="w-14 h-14 rounded-xl mr-4" alt="">
            </a>
            <div>
                @if($comment->user->isAdmin())
                    <h4 class="uppercase font-semibold text-xl">Change by admin</h4>
                @endif
                <p class="line-clamp-3">
                    {{$comment->body}}
                </p>
            </div>

        </div>

    </div>

    <div class="flex justify-between items-center  px-5 py-2">
        <div class="flex items-center text-xs space-x-4 ml-4 flex px-5 py-4">
            <span class="font-semibold">{{$comment->user->name}}</span>
            <span class="text-2xl text-gray-300">•</span>
            <span class="text-gray-400">{{$comment->created_at->diffForHumans()}}</span>
        </div>
        <div class="flex space-x-6" x-data="{showDialog:false}">
            <button @click="showDialog = !showDialog"
                    class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                <ul @click.outside.window="showDialog = false" x-show="showDialog" x-transition class="space-y-4 lg:left-0 right-0 top-9 absolute w-44 font-semibold bg-white shadow-lg rounded-xl py-3">
                    <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Mark as spam</a></li>
                    <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2"><a href="" class="px-5 py-3 font-bold">Delete post</a></li>
                </ul>
            </button>
        </div>
    </div>
</div>
