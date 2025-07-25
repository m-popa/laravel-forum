<?php

namespace App\Livewire\Comment;

use Exception;
use App\Models\Comment;
use Livewire\Component;
use App\Data\CommentData;
use Livewire\Attributes\On;
use Filament\Schemas\Schema;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Computed;
use App\Actions\CreateCommentAction;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Concerns\InteractsWithSchemas;

class CreateComment extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    #[Locked]
    public int $threadId;

    public ?int $parentId = null;

    public ?string $body = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Textarea::make('body')
                        ->hiddenLabel()
                        ->rows(5)
                        ->minLength(3)
                        ->maxLength(1000)
                        ->required(),
            ]);
    }


    #[Computed]
    public function parentPreview(): ?array
    {
        $comment = Comment::find($this->parentId);

        if (!$comment) {
            return null;
        }

        return [
            'name' => $comment->user->name,
            'preview' => $comment->body,
        ];
    }

    #[On('reply-to-comment')]
    public function setParent(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function create(CreateCommentAction $action): void
    {
        $this->validate();

        $data = $this->form->getState();

        $commentData = CommentData::from([
            'thread_id' => $this->threadId,
            'body' => $data['body'],
            'parent_id' => $this->parentId,
        ]);

        $action->execute(user: Auth::user(), data: $commentData);

        $this->form->fill();

        $this->dispatch('replyCreated');
    }
}
