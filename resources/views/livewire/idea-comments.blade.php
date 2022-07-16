@if($idea->comments->isNotEmpty())
    <div class="comments-container relative space-y-4">
        @foreach($idea->comments as $comment)
            <livewire:idea-comment :idea="$idea" :comment="$comment" :key="$comment->id"/>
        @endforeach
    </div>
@else
    <div>
        <img style="mix-blend-mode: luminosity" src="{{asset('images/no-ideas.svg')}}" alt="No-idea" class="mx-auto">
        <h3 class="text-gray-400 text-center font-bold mt-6 text-lg">No comment found...</h3>
    </div>
@endif
