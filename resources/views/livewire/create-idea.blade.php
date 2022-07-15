<form  x-data="{show:true}" wire:submit.prevent="createIdea" action="" class="px-2 py-4">
{{--    @if($message = session('success_message'))--}}
{{--    <div class="bg-green text-white w-full rounded-xl px-2 py-2 my-2"--}}
{{--         x-init="setTimeout(() => {--}}
{{--         show = false--}}
{{--         }, 5000)"--}}
{{--         x-transition x-show="show" @click="show=false">--}}
{{--        <p>--}}
{{--            {{$message}}--}}
{{--        </p>--}}
{{--    </div>--}}
{{--    @endif--}}
    <div class="space-y-4">
        <input wire:model.debounce.500ms="title" placeholder="Your idea" class=" w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" type="text" name="" id="">
        @error('title')
        <span class="text-red mt-2">{{$message}}</span>
        @enderror
        <select wire:model.debounce.500ms="category" class="w-full px-2 py-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" name="" id="">
            <option value="">Category</option>
           @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        @error('category')
        <span class="text-red mt-2">{{$message}}</span>
        @enderror
        <textarea wire:model.debounce.500ms="description" placeholder="Describe your idea" class="w-full px-2 px-4 placeholder-gray-700 bg-gray-100 rounded-xl border-none" name="" id="" cols="30" rows="10"></textarea>
        @error('description')
        <span class="text-red mt-2">{{$message}}</span>
        @enderror
        <div class="flex items-center justify-between">
            <input type="file" name="" style="display: none" id="attachFile">
            <label for="attachFile" class="flex items-center cursor-pointer px-6 py-4 bg-gray-100 rounded-xl"><svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                </svg><span>Attach</span></label>
            <button  class="px-6 py-4 placeholder-gray-700 bg-gray-100 rounded-xl bg-blue text-white">Submit</button>
        </div>
    </div>

</form>
