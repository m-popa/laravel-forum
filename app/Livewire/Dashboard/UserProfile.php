<?php

namespace App\Livewire\Dashboard;

use Exception;
use App\Models\User;
use Livewire\Component;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

class UserProfile extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public User $user;

    public ?array $data = [];

    public function mount(): void
    {
        $this->user = Auth::user();

        $this->form->fill([
            'name' => $this->user->name,
        ]);
    }

    /**
     * @throws Exception
     */
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                SpatieMediaLibraryFileUpload::make('avatar')
                                            ->label('Avatar')
                                            ->model($this->user)
                                            ->collection('avatars')
                                            ->avatar(),

                TextInput::make('name')
                         ->label('Name')
                         ->required(),

            ])
            ->model(User::class)
            ->statePath('data');
    }

    public function create(): void
    {
        $this->validate();

        Auth::user()->update($this->data);

        $this->form->model()->saveRelationships();

        $this->redirectRoute('dashboard');
    }

    public function render()
    {
        return view('livewire.dashboard.user-profile');
    }
}
