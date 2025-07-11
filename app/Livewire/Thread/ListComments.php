<?php

namespace App\Livewire\Thread;

use App\Models\Thread;
use Livewire\Component;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ListComments extends Component
{
    use WithPagination;

    #[Locked]
    public int $threadId;

    public int $page = 1;

    #[On('replyCreated')]
    public function refreshReplies(): void
    {
        $lastPage   = $this->comments()->lastPage();
        $this->page = $lastPage;
        $this->dispatch('$refresh');
    }

    #[Computed]
    public function comments(): LengthAwarePaginator
    {
        return Thread::findOrFail($this->threadId)
                     ->comments()
                     ->with('user')
                     ->paginate(10, ['*'], 'page', $this->page);
    }

    public function render(): View
    {
        return view('livewire.thread.list-comments', [
            'comments' => $this->comments,
        ]);
    }
}
