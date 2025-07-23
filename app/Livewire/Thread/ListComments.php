<?php

namespace App\Livewire\Thread;

use App\Models\Thread;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class ListComments extends Component
{
    use WithPagination;

    #[Locked]
    public int $threadId;

    #[On('replyCreated')]
    public function refreshReplies(): void
    {
        $this->gotoPage($this->comments()->lastPage());
    }

    #[Computed]
    public function comments(): LengthAwarePaginator
    {
        return $this->thread->comments()
            ->with([
                'user',
                'votes' => fn ($query) => $query->where('user_id', Auth::id()),
            ])
            ->paginate(10);
    }

    #[Computed]
    public function thread(): Thread
    {
        return Thread::findOrFail($this->threadId);
    }

    public function render(): View
    {
        return view('livewire.thread.list-comments', [
            'comments' => $this->comments,
        ]);
    }
}
