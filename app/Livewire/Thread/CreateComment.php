<?php

namespace App\Livewire\Thread;

use Exception;
use App\Models\Comment;
use Livewire\Component;
use Livewire\Attributes\On;
use Filament\Schemas\Schema;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;
use App\Actions\CreateCommentAction;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Concerns\InteractsWithSchemas;

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
                              ->label('Content')
                              ->toolbarButtons([
                                  ['bold', 'italic', 'strike', 'link'],
                                  ['codeBlock', 'bulletList', 'orderedList'],
                              ])
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
            'preview' => str($comment->body)->limit(120),
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
            'body' => $this->body,
        ]);

        $this->reset('body', 'parentId');

        $this->dispatch('replyCreated');
    }
}
