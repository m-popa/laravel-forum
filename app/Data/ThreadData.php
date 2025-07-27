<?php

declare(strict_types=1);

namespace App\Data;

final readonly class ThreadData
{
    public function __construct(
        public string $title,
    ) {}

    public static function from(array $data): self
    {
        return new self(
            title: trim($data['title']),
        );
    }
}
