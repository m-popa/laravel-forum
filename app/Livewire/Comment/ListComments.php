<?php

namespace App\Livewire\Comment;

use App\Models\Thread;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListComments extends Component
{
    use WithPagination;

    public Thread $thread;

    #[On('replyCreated')]
    public function refreshReplies(): void
    {
        $this->gotoPage($this->comments()->lastPage());
    }

    #[Computed]
    public function comments(): LengthAwarePaginator
    {
        return $this->thread->comments()->published()->paginate(10);
    }

    public function render(): View
    {
        return view('livewire.comment.list-comments', [
            'comments' => $this->comments,
        ]);
    }
}
