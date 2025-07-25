<?php

namespace App\Livewire\Comment;

use App\Actions\CreateCommentAction;
use App\Models\Comment;
use Exception;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateComment extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    #[Locked]
    public int $threadId;

    public ?int $parentId = null;

    #[Validate('required|string|min:3')]
    public string $body = '';

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                MarkdownEditor::make('body')
                    ->hiddenLabel()
                    ->toolbarButtons([
                        ['bold', 'italic', 'strike', 'link'],
                        ['codeBlock', 'bulletList', 'orderedList'],
                    ])
                    ->minLength(3)
                    ->required(),
            ]);
    }

    #[Computed]
    public function parentPreview(): ?array
    {
        $comment = Comment::find($this->parentId);

        if (! $comment) {
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

        $action->execute(Auth::user(), [
            'thread_id' => $this->threadId,
            'parent_id' => $this->parentId,
            'body' => $this->form->getState()['body'],
        ]);

        $this->reset('body', 'parentId');

        $this->dispatch('replyCreated');
    }
}
