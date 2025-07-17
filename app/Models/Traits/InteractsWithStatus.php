<?php

namespace App\Models\Traits;

use App\Enums\Status;

trait InteractsWithStatus
{
    public function scopePublished($query)
    {
        return $query->where('status', Status::Published->value);
    }

    public function scopePending($query)
    {
        return $query->where('status', Status::Pending->value);
    }

    public function scopeRejected($query)
    {
        return $query->where('status', Status::Rejected->value);
    }

    public function markAsPublished(): static
    {
        return $this->setStatus(Status::Published);
    }

    public function setStatus(Status $status): static
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

    public function hasStatus(Status $status): bool
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
