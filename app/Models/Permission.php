<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Permission extends \Spatie\Permission\Models\Permission
{
    use HasFactory;
    use HasUuids;
    protected $primaryKey = 'uuid';

    public static function defaultPermissions()
    {
        return [
            'view_users',
            'create_users',
            'edit_users',
            'delete_users',
            'import_users',
            'view_monitor',

            'view_roles',
            'create_roles',
            'edit_roles',
            'delete_roles',

            'view_pegawais',
            'create_pegawais',
            'edit_pegawais',
            'delete_pegawais',

            'view_instansis',
            'create_instansis',
            'edit_instansis',
            'delete_instansis',
        ];
    }
}
