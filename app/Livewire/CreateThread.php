<?php

namespace App\Livewire;

use Exception;
use App\Models\Thread;
use Livewire\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Schemas\Concerns\InteractsWithSchemas;

class CreateThread extends Component implements HasSchemas
{
    use InteractsWithSchemas;

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
                         ->required(),
                MarkdownEditor::make('content'),

                Select::make('category_id')
                      ->relationship('category', 'name')
                      ->required(),
            ])
            ->model(Thread::class)
            ->statePath('data');
    }

    public function create(): void
    {
        $this->validate();

        $data            = $this->form->getState();
        $data['user_id'] = Auth::id();

        $thread = Thread::create($data);

        $this->redirectRoute('categories.show', $thread->category);
    }

    public function render()
    {
        return view('livewire.create-thread');
    }
}
