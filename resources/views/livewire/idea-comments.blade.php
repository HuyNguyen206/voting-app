@if($comments->isNotEmpty())
    <div>
        <div class="comments-container relative space-y-4">
            @foreach($comments as $comment)
                <livewire:idea-comment :idea="$idea" :comment="$comment" :key="$comment->id"/>
            @endforeach
        </div>
        <div class="my-8">
            {!! $comments->onEachSide(3)->links() !!}
        </div>
    </div>

@else
    <div>
        <img src="{{asset('images/no-ideas.svg')}}" alt="No-idea" class="mx-auto mix-blend-luminosity">
        <h3 class="text-gray-400 text-center font-bold mt-6 text-lg">No comment found...</h3>
    </div>
@endif
