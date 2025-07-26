<?php

namespace App\Livewire\Comment;

use Exception;
use App\Models\Comment;
use Livewire\Component;
use Filament\Schemas\Schema;
use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Concerns\InteractsWithSchemas;

class CommentCard extends Component implements HasSchemas
{
    use InteractsWithSchemas;

    public Comment $comment;

    /**
     * @throws Exception
     */
    public function commentInfolist(Schema $schema): Schema
    {
        return $schema
            ->record($this->comment)
            ->components([
                TextEntry::make('body')
                         ->hiddenLabel()
                         ->markdown(),
            ]);
    }

    public function replyToComment(): void
    {
        $this->dispatch('reply-to-comment', parentId: $this->comment->id);
    }

    public function render(): View
    {
        return view('livewire.comment.comment-card', [
            'votingEnabled' => app(GeneralSettings::class)->voting_enabled,
        ]);
    }
}
