<?php

namespace App\Livewire\Thread;

use App\Actions\CreateCommentAction;
use App\Actions\CreateThreadAction;
use App\Data\CommentData;
use App\Data\ThreadData;
use App\Models\Category;
use App\Models\Thread;
use Exception;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateThread extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public Category $category;

    public ?array $data = [];

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
                TextInput::make('title')
                    ->label('Title')
                    ->required(),

                MarkdownEditor::make('body')
                    ->label('Content')
                    ->toolbarButtons([
                        ['bold', 'italic', 'strike', 'link'],
                        ['codeBlock', 'bulletList', 'orderedList'],
                    ])
                    ->required()
                    ->minLength(5)
                    ->maxLength(5000),
            ])
            ->model(Thread::class)
            ->statePath('data');
    }

    public function create(CreateThreadAction $createThread, CreateCommentAction $createComment): void
    {
        $this->validate();

        $formData = $this->form->getState();

        $threadData = ThreadData::from($formData);

        $thread = $createThread->execute(
            user: Auth::user(),
            category: $this->category,
            data: $threadData,
        );

        $commentData = CommentData::from([
            'body' => $formData['body'],
            'thread_id' => $thread->id,
            'parent_id' => $formData['parent_id'] ?? null,
        ]);

        $createComment->execute(
            user: Auth::user(),
            data: $commentData,
        );

        $this->redirectRoute('threads.index', $thread->category);
    }
}
