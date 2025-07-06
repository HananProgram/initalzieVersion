<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Agency;
use Illuminate\Auth\Access\Response;

class ThemePolicy
{
    public function update(User $user, Agency $agency)
    {
        // فقط مدير الوكالة أو المشرف العام يمكنه تغيير اللون
        return $user->isAgencyAdmin() || $user->isSuperAdmin()
            ? Response::allow()
            : Response::deny('ليس لديك صلاحية لتغيير لون الثيم');
    }
}