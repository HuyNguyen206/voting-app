<div id="comment-{{$comment->id}}" x-transition
     class="comment relative transition duration-500 @if($comment->is_update_status) status-{{Str::kebab($comment->status->name)}} is-admin border-blue border-2 @endif rounded-xl bg-white">
    <div class="flex">
        <div class="ml-4 flex px-5 py-8">
            <a class="flex flex-none flex-col items-center justify-between">
                <img src="{{$comment->user->avatar()}}" class="w-14 h-14 rounded-xl" alt="">
                @if($commenterIsAdmin = $comment->user->isAdmin())
                <span class="text-blue mt-2">ADMIN</span>
                @endif
            </a>
            <div class="ml-4">
                @if($comment->is_update_status)
                    <h4 class="uppercase font-semibold text-xl text-blue">{{$comment->getStatusChange()}}</h4>
                @endif
                <p class="line-clamp-3">
                    @admin
                @if($comment->spam_reports)
                    <p class="text-red mb-2">Spam reports: {{$comment->spam_reports}}</p>
                @endif
                @endadmin
                    {!! nl2br(e($comment->body)) !!}
                </p>
            </div>

        </div>

    </div>

    <div class="flex justify-between items-center  px-5 py-2">
        <div class="flex items-center text-xs space-x-4 ml-4 flex px-5 py-4">
            <span class="font-semibold @if($commenterIsAdmin) text-blue @endif">{{$comment->user->name}}</span>
            <span class="text-2xl text-gray-300">•</span>
            @if($comment->user_id === $idea->user_id)
                <div class="rounded-full border bg-gray-100 px-3 py-1">OP</div>
            @endif
            <span class="text-gray-400">{{$comment->created_at->diffForHumans()}}</span>
        </div>
        @auth
            <div class="flex space-x-6" x-cloak="" x-data="{showDialog:false}">
                <button @click="showDialog = !showDialog"
                        class="relative flex items-center px-6 py-2 font-semibold uppercase rounded-xl text-gray-400 bg-gray-300">
                    <span><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                               stroke="currentColor" stroke-width="2">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z"/>
</svg></span>
                    <ul @click.outside.window="showDialog = false" x-show="showDialog" x-transition
                        class="z-10 mb-2 space-y-4 lg:left-0 right-0 top-9 absolute w-48 font-semibold bg-white shadow-lg rounded-xl py-3">
                        @can('update', $comment)
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2">
                                <a href="" class="px-5 py-3 font-bold"
                                   @click.prevent.stop="showDialog = false; Livewire.emit('setEditComment', {{$comment->id}})"
                                >Edit comment</a>
                            </li>
                        @endcan
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2">
                            <a @click.prevent.stop="showDialog = false; Livewire.emit('setMarkCommentAsSpam', {{$comment->id}}); $dispatch('custom-show-mark-spam-comment', {{$comment->id}})"
                               class="px-5 py-3 font-bold">Mark as spam</a>
                        </li>
                            @if($comment->spam_reports)
                        <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2">
                            <a @click.prevent.stop="showDialog = false; Livewire.emit('setMarkCommentAsNotSpam', {{$comment->id}}); $dispatch('custom-show-mark-not-spam-comment', {{$comment->id}})"
                               class="px-5 py-3 font-bold">Mark as not spam</a>
                        </li>
                            @endif
                        @can('delete', $comment)
                            <li class="text-left hover:bg-gray-100 transition font-semibold duration-150 py-2">
                                <a href="" class="px-5 font-bold inline-block"
                                   @click.prevent.stop="showDialog = false; Livewire.emit('setDeleteComment', {{$comment->id}}); $dispatch('custom-show-delete-comment', {{$comment->id}})">Delete
                                    comment</a></li>
                        @endcan
                    </ul>
                </button>
            </div>
        @endauth
    </div>
</div>
