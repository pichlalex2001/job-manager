<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'job_create',
            ],
            [
                'id'    => 18,
                'title' => 'job_edit',
            ],
            [
                'id'    => 19,
                'title' => 'job_show',
            ],
            [
                'id'    => 20,
                'title' => 'job_access',
            ],
            [
                'id'    => 21,
                'title' => 'bewerber_create',
            ],
            [
                'id'    => 22,
                'title' => 'bewerber_edit',
            ],
            [
                'id'    => 23,
                'title' => 'bewerber_show',
            ],
            [
                'id'    => 24,
                'title' => 'bewerber_access',
            ],
            [
                'id'    => 25,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 26,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 27,
                'title' => 'team_create',
            ],
            [
                'id'    => 28,
                'title' => 'team_edit',
            ],
            [
                'id'    => 29,
                'title' => 'team_show',
            ],
            [
                'id'    => 30,
                'title' => 'team_delete',
            ],
            [
                'id'    => 31,
                'title' => 'team_access',
            ],
            [
                'id'    => 32,
                'title' => 'fragen_create',
            ],
            [
                'id'    => 33,
                'title' => 'fragen_edit',
            ],
            [
                'id'    => 34,
                'title' => 'fragen_show',
            ],
            [
                'id'    => 35,
                'title' => 'fragen_delete',
            ],
            [
                'id'    => 36,
                'title' => 'fragen_access',
            ],
            [
                'id'    => 37,
                'title' => 'antworten_create',
            ],
            [
                'id'    => 38,
                'title' => 'antworten_edit',
            ],
            [
                'id'    => 39,
                'title' => 'antworten_show',
            ],
            [
                'id'    => 40,
                'title' => 'antworten_delete',
            ],
            [
                'id'    => 41,
                'title' => 'antworten_access',
            ],
            [
                'id'    => 42,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
