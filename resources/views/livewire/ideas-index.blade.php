<div>
    <div class="filters flex flex-col lg:flex-row lg:space-x-6">
        <div class="lg:w-1/3 mt-2 lg:mt-0 mx-2 lg:mx-0">
            <select wire:model="category" name="category" id="" class="border-none w-full rounded-xl px-4 px-4">
                <option value="">All category</option>
                @foreach($categories as $category)
                    <option value="{{$category->slug}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="lg:w-1/3 mt-2 lg:mt-0 mx-2 lg:mx-0">
            <select wire:model="filter" name="other_filter" id="" class="border-none w-full rounded-xl px-4 px-4">
                <option value="">No filter</option>
                <option value="top_voted">Top voted</option>
                <option value="my_ideas">My ideas</option>
                @admin
                <option value="most_spam_idea">Most Spam idea</option>
                <option value="most_spam_comment">Most Spam comment</option>
                @endadmin
            </select>
        </div>
        <div class="lg:w-1/3 relative mt-2 lg:mt-0 mx-2 lg:mx-0">
            <input wire:model.debounce.300ms="search" type="search" placeholder="Find an idea"
                   class="w-full rounded-xl bg-white px-4 py-2 pl-8 border-none">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg class="h-6 w-6 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="ideas-container  duration-150 space-y-6 my-6">
        @forelse($ideas as $idea)
            <livewire:idea-index :idea="$idea" :key="$idea->id"/>
        @empty
            <div>
                <img src="{{asset('images/no-ideas.svg')}}" alt="No-idea" class="mx-auto mix-blend-luminosity">
                <h3 class="text-gray-400 text-center font-bold mt-6 text-lg">No idea found...</h3>
            </div>
        @endforelse
        {!! $ideas->links() !!}
    </div>

</div>
