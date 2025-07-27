<?php

declare(strict_types=1);

namespace App\Data;

final readonly class CommentData
{
    public function __construct(
        public string $body,
        public int $thread_id,
        public ?int $parent_id = null,
    ) {}

    public static function from(array $data): self
    {
        return new self(
            body: trim($data['body']),
            thread_id: (int) $data['thread_id'],
            parent_id: isset($data['parent_id']) ? (int) $data['parent_id'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'body' => $this->body,
            'thread_id' => $this->thread_id,
            'parent_id' => $this->parent_id,
        ];
    }
}
