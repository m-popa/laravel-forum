<?php

namespace App\Livewire\Comment;

use Exception;
use Livewire\Component;
use App\Models\Comment;
use Filament\Schemas\Schema;
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
                         ->markdown()
                         ->hiddenLabel(),
            ]);
    }

    public function replyToComment(): void
    {
        $this->dispatch('reply-to-comment', parentId: $this->comment->id);
    }
}
