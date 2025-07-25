<?php

declare(strict_types=1);

namespace App\Data;

final readonly class CommentData
{
    public function __construct(
        public int $thread_id,
        public string $body,
        public ?int $parent_id = null,
    ) {
    }

    public static function from(array $data): self
    {
        return new self(
            thread_id: (int) $data['thread_id'],
            body: trim($data['body']),
            parent_id: isset($data['parent_id']) ? (int) $data['parent_id'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'thread_id' => $this->thread_id,
            'body' => $this->body,
            'parent_id' => $this->parent_id,
        ];
    }
}
