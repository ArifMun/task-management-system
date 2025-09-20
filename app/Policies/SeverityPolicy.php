<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Severity;
use Illuminate\Auth\Access\HandlesAuthorization;

class SeverityPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Severity');
    }

    public function view(AuthUser $authUser, Severity $severity): bool
    {
        return $authUser->can('View:Severity');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Severity');
    }

    public function update(AuthUser $authUser, Severity $severity): bool
    {
        return $authUser->can('Update:Severity');
    }

    public function delete(AuthUser $authUser, Severity $severity): bool
    {
        return $authUser->can('Delete:Severity');
    }

    public function restore(AuthUser $authUser, Severity $severity): bool
    {
        return $authUser->can('Restore:Severity');
    }

    public function forceDelete(AuthUser $authUser, Severity $severity): bool
    {
        return $authUser->can('ForceDelete:Severity');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Severity');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Severity');
    }

    public function replicate(AuthUser $authUser, Severity $severity): bool
    {
        return $authUser->can('Replicate:Severity');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Severity');
    }

}