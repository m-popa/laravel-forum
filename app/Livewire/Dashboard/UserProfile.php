<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Exception;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
                    ->imageEditor()
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

        Auth::user()->update($this->form->getState());

        $this->form->model()->saveRelationships();

        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();
    }
}
