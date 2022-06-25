<div class="relative mt-2 lg:mt-0" x-data="{showStatus: false}" @idea-updated.window="showStatus = false">
    <button @click="showStatus = !showStatus"  placeholder="Set status" class="w-32 px-2 px-8 h-10 text-gray-500  bg-gray-300 rounded-xl border-none" name="" id="">Set status</button>
    <div @keydown.esc.window="showStatus = false" x-cloak @click.outside.window="showStatus = false" x-show="showStatus" x-transition class="absolute lg:w-160 w-80 bg-white rounded-xl text-sm z-10 px-2 py-4 shadow-md">
        <form wire:submit.prevent="updateIdea" class="px-2 py-4" action="">
            <div class="mt-2">
                @foreach($statuses as $status)
                    <div>
                        <label class="inline-flex items-center">
                            <input class="form-radio" type="radio" checked="" wire:model="status" name="radio-direct" value="{{$status->id}}">
                            <span class="ml-2">{{$status->name}}</span>
                        </label>
                    </div>
                @endforeach
            </div>
            <textarea wire:model='description' class="placeholder-gray-500 mt-2 border-none w-full rounded-xl bg-gray-200" placeholder="Go ahead, don't be shy. Share your thought..." cols="30" rows="4"></textarea>
            <div class="flex flex-col lg:flex-row lg:space-x-4 mt-2">
                <button class="w-full bg-blue text-white px-4 py-2 rounded-xl disabled:opacity-25">Update</button>
                <div class="w-full flex items-center justify-between">
                    <input type="file" name="" style="display: none" id="attachFileComment">
                    <label for="attachFileComment" class="w-full flex items-center justify-center cursor-pointer px-6 py-4 bg-gray-100 rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                        </svg><span>Attach</span></label>
                </div>

            </div>
            <div class="mt-2">
                <label class="inline-flex items-center">
                    <input class="form-checkbox" type="checkbox" wire:model="notifyUser">
                    <span class="ml-2">Notify all users</span>
                </label>
            </div>
        </form>
    </div>
</div>
