<?php

namespace App\Models\Concerns;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Builder;

trait InteractsWithStatus
{
    public function scopePublished($query): Builder
    {
        return $query->where('status', Status::Published);
    }

    public function scopePending($query): Builder
    {
        return $query->where('status', Status::Pending);
    }

    public function scopeRejected($query): Builder
    {
        return $query->where('status', Status::Rejected);
    }

    public function markAsPublished(): static
    {
        return $this->setStatus(Status::Published);
    }

    protected function setStatus(Status $status): static
    {
        $this->update(['status' => $status]);

        return $this;
    }

    public function markAsPending(): static
    {
        return $this->setStatus(Status::Pending);
    }

    public function markAsRejected(): static
    {
        return $this->setStatus(Status::Rejected);
    }

    public function isPublished(): bool
    {
        return $this->hasStatus(Status::Published);
    }

    protected function hasStatus(Status $status): bool
    {
        return $this->status === $status;
    }

    public function isPending(): bool
    {
        return $this->hasStatus(Status::Pending);
    }

    public function isRejected(): bool
    {
        return $this->hasStatus(Status::Rejected);
    }
}
