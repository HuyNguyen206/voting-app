@props([
'idea',
 ])

@can('update', $idea)
    <livewire:edit-idea :idea="$idea"/>
@endcan

@can('delete', $idea)
    <livewire:delete-idea :idea="$idea"/>
@endcan

@can('markAsSpam', $idea)
    <livewire:mark-idea-as-spam :idea="$idea"/>
@endcan

@can('markAsNotSpam', $idea)
    <livewire:mark-idea-as-not-spam :idea="$idea"/>
@endcan

@auth
    <livewire:edit-comment />
    <livewire:delete-comment />
    <livewire:mark-comment-as-spam />
    <livewire:mark-comment-as-not-spam />
@endauth

