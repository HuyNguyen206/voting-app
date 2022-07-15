<!-- This example requires Tailwind CSS v2.0+ -->
<div class="relative z-10"
     aria-labelledby="modal-title"
     role="dialog" aria-modal="true"
     x-data="{isShow: false}"
     @click.outside="isShow = false"
     x-cloak
     @keydown.escape.window="isShow = false"
     x-show="isShow"
     @custom-show-edit-idea.window="isShow = true;  $nextTick(() => {$refs.titleInput.focus()})"
     @update-idea.window="isShow = false; $dispatch('custom-show-notification', 'Idea was updated successfully!')">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

    <div class="fixed z-10 inset-0 overflow-y-auto">
        <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
            <div class="model bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-lg sm:w-full">
                <div class="absolute top-0 right-0 pt-4 pr-4 text-lg cursor-pointer">
                    <button class="text-gray-400 hover:text-gray-500" @click="isShow = false">&times;</button>
                </div>
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-center text-lg font-medium text-gray-900">Edit idea</h3>
                    <p class="text-xs text-center text-gray-500 mt-4">You have one hour to edit your idea from the time you created</p>
                    <form  wire:submit.prevent="updateIdea" action="" class="px-2 py-4">
                        <div class="space-y-4">
                            <input wire:model.debounce.500ms="title" x-ref="titleInput" placeholder="Your idea"
                                   class=" w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none"
                                   type="text"  id="" required>
                            @error('title')
                            <span class="text-red mt-2">{{$message}}</span>
                            @enderror
                            <select wire:model.debounce.500ms="category"
                                    class="w-full px-2 py-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none"
                                    name="" id="">
                                <option value="">Category</option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                            @error('category')
                            <span class="text-red mt-2">{{$message}}</span>
                            @enderror
                            <textarea wire:model.debounce.500ms="description" placeholder="Describe your idea"
                                      class="w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none"
                                      name="" id="" cols="30" rows="10"></textarea>
                            @error('description')
                            <span class="text-red mt-2">{{$message}}</span>
                            @enderror
                            <div class="flex items-center justify-between">
                                <input type="file" name="" style="display: none" id="attachFile">
                                <label for="attachFile"
                                       class="flex items-center cursor-pointer px-6 py-4 bg-gray-100 rounded-xl">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                    </svg>
                                    <span>Attach</span></label>
                                <button
                                    class="px-6 py-4 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white">
                                    Submit
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
