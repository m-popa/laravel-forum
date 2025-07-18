<?php

namespace App\Livewire\Thread;

use Exception;
use App\Models\Thread;
use Livewire\Component;
use App\Models\Category;
use Filament\Schemas\Schema;
use App\Actions\CreateThreadAction;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Concerns\InteractsWithSchemas;

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

    public function create(CreateThreadAction $action): void
    {
        $this->validate();

        $thread = $action->execute(
            user: Auth::user(),
            category: $this->category,
            data: $this->form->getState(),
        );

        $this->redirectRoute('threads.index', $thread->category);
    }
}
