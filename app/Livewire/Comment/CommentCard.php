<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Exception;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Livewire\Component;

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
