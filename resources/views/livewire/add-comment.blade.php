<div class="relative" x-data="{showReply : false}" @add-comment.window="showReply = false; $dispatch('custom-show-notification', {'message': 'Add comment successfully!', 'is_success':true})">
    <button @click="showReply = !showReply; $nextTick(() => {$refs.bodyInput.focus()})" class="mr-2 md:my-0 my-2 px-8 h-10 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white">Reply</button>
    <div x-cloak x-show="showReply" @click.outside.window="showReply = false" x-transition class="mt-3 absolute lg:w-160 w-96 bg-white rounded-xl text-sm z-10 px-2 py-4 shadow-md">
        @auth
            <form wire:submit.prevent="addComment" class="px-2 py-4"
            x-init="Livewire.hook('message.processed', (message, component) =>
            {
             console.log(message)
            if(message.updateQueue[0].payload.event === 'updateIdea'
            && message.component.fingerprint.name === 'idea-comments') {
            const lastComment = document.querySelector('.comment:last-child')
            console.log(lastComment)

            lastComment.scrollIntoView({behavior: 'smooth'})
            lastComment.classList.add('bg-green-50')
            setTimeout(() => {
             lastComment.classList.remove('bg-green-50')
            }, 2000)
            }

            if(['gotoPage', 'nextPage', 'previousPage'].includes(message.updateQueue[0].method)){
              const firstComment = document.querySelector('.comment:first-child')
              firstComment.scrollIntoView({behavior: 'smooth'})
            }

            })
            @if($commentId = session('scroll_to_comment'))
                let lastComment = document.querySelector('#comment-{{$commentId}}')
                console.log(lastComment)

                lastComment.scrollIntoView({behavior: 'smooth'})
                lastComment.classList.add('bg-green-50')
                setTimeout(() => {
                 lastComment.classList.remove('bg-green-50')
                }, 2000)
            @endif
            ">
                <textarea x-ref="bodyInput" required wire:en wire:model="body" class="border-none w-full rounded-xl bg-gray-100" placeholder="Go ahead, don't be shy. Share your thought..." cols="30" rows="4"></textarea>
                @error('body')
                <span class="text-red mt-2">{{$message}}</span>
                @enderror
                <div class="flex flex-col lg:flex-row lg:space-x-4 mt-2">
                    <button class="bg-blue text-white px-4 py-2 rounded-xl">Post Comment</button>
                    <div class="flex items-center justify-between">
                        <input type="file" name="" style="display: none" id="attachFile">
                        <label for="attachFile" class="flex items-center cursor-pointer px-6 py-4 bg-gray-100 rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg><span>Attach</span></label>
                    </div>
                </div>

            </form>
        @else
            <div>
                <p class="text-center">Please login or register to add comment</p>
            </div>
            <div class="flex mt-2 space-x-4">
                <a style="display:block" class="text-center px-6 w-1/2 py-4 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white" href="{{route('login')}}">Login</a>
                <a style="display:block" class="text-center px-6 w-1/2 py-4 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white" href="{{route('register')}}">Register</a>
            </div>
        @endauth
    </div>
</div>
