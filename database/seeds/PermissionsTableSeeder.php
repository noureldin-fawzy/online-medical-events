<?php

use App\Models\Permission;
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
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'event_create',
            ],
            [
                'id'    => 20,
                'title' => 'event_edit',
            ],
            [
                'id'    => 21,
                'title' => 'event_show',
            ],
            [
                'id'    => 22,
                'title' => 'event_delete',
            ],
            [
                'id'    => 23,
                'title' => 'event_access',
            ],
            [
                'id'    => 24,
                'title' => 'topic_create',
            ],
            [
                'id'    => 25,
                'title' => 'topic_edit',
            ],
            [
                'id'    => 26,
                'title' => 'topic_show',
            ],
            [
                'id'    => 27,
                'title' => 'topic_delete',
            ],
            [
                'id'    => 28,
                'title' => 'topic_access',
            ],
            [
                'id'    => 29,
                'title' => 'board_create',
            ],
            [
                'id'    => 30,
                'title' => 'board_edit',
            ],
            [
                'id'    => 31,
                'title' => 'board_show',
            ],
            [
                'id'    => 32,
                'title' => 'board_delete',
            ],
            [
                'id'    => 33,
                'title' => 'board_access',
            ],
            [
                'id'    => 34,
                'title' => 'speaker_create',
            ],
            [
                'id'    => 35,
                'title' => 'speaker_edit',
            ],
            [
                'id'    => 36,
                'title' => 'speaker_show',
            ],
            [
                'id'    => 37,
                'title' => 'speaker_delete',
            ],
            [
                'id'    => 38,
                'title' => 'speaker_access',
            ],
            [
                'id'    => 39,
                'title' => 'schedule_create',
            ],
            [
                'id'    => 40,
                'title' => 'schedule_edit',
            ],
            [
                'id'    => 41,
                'title' => 'schedule_show',
            ],
            [
                'id'    => 42,
                'title' => 'schedule_delete',
            ],
            [
                'id'    => 43,
                'title' => 'schedule_access',
            ],
            [
                'id'    => 44,
                'title' => 'sponsor_create',
            ],
            [
                'id'    => 45,
                'title' => 'sponsor_edit',
            ],
            [
                'id'    => 46,
                'title' => 'sponsor_show',
            ],
            [
                'id'    => 47,
                'title' => 'sponsor_delete',
            ],
            [
                'id'    => 48,
                'title' => 'sponsor_access',
            ],
            [
                'id'    => 49,
                'title' => 'exhibition_create',
            ],
            [
                'id'    => 50,
                'title' => 'exhibition_edit',
            ],
            [
                'id'    => 51,
                'title' => 'exhibition_show',
            ],
            [
                'id'    => 52,
                'title' => 'exhibition_delete',
            ],
            [
                'id'    => 53,
                'title' => 'exhibition_access',
            ],
            [
                'id'    => 54,
                'title' => 'exhibition_detail_create',
            ],
            [
                'id'    => 55,
                'title' => 'exhibition_detail_edit',
            ],
            [
                'id'    => 56,
                'title' => 'exhibition_detail_show',
            ],
            [
                'id'    => 57,
                'title' => 'exhibition_detail_delete',
            ],
            [
                'id'    => 58,
                'title' => 'exhibition_detail_access',
            ],
            [
                'id'    => 59,
                'title' => 'event_attendee_show',
            ],
            [
                'id'    => 60,
                'title' => 'event_attendee_delete',
            ],
            [
                'id'    => 61,
                'title' => 'event_attendee_access',
            ],
            [
                'id'    => 62,
                'title' => 'specialty_create',
            ],
            [
                'id'    => 63,
                'title' => 'specialty_edit',
            ],
            [
                'id'    => 64,
                'title' => 'specialty_show',
            ],
            [
                'id'    => 65,
                'title' => 'specialty_delete',
            ],
            [
                'id'    => 66,
                'title' => 'specialty_access',
            ],
            [
                'id'    => 67,
                'title' => 'contact_create',
            ],
            [
                'id'    => 68,
                'title' => 'contact_edit',
            ],
            [
                'id'    => 69,
                'title' => 'contact_show',
            ],
            [
                'id'    => 70,
                'title' => 'contact_delete',
            ],
            [
                'id'    => 71,
                'title' => 'contact_access',
            ],
            [
                'id'    => 72,
                'title' => 'organizer_create',
            ],
            [
                'id'    => 73,
                'title' => 'organizer_edit',
            ],
            [
                'id'    => 74,
                'title' => 'organizer_show',
            ],
            [
                'id'    => 75,
                'title' => 'organizer_delete',
            ],
            [
                'id'    => 76,
                'title' => 'organizer_access',
            ],
            [
                'id'    => 77,
                'title' => 'registration_access',
            ],
            [
                'id'    => 78,
                'title' => 'country_create',
            ],
            [
                'id'    => 79,
                'title' => 'country_edit',
            ],
            [
                'id'    => 80,
                'title' => 'country_show',
            ],
            [
                'id'    => 81,
                'title' => 'country_delete',
            ],
            [
                'id'    => 82,
                'title' => 'country_access',
            ],
            [
                'id'    => 83,
                'title' => 'city_create',
            ],
            [
                'id'    => 84,
                'title' => 'city_edit',
            ],
            [
                'id'    => 85,
                'title' => 'city_show',
            ],
            [
                'id'    => 86,
                'title' => 'city_delete',
            ],
            [
                'id'    => 87,
                'title' => 'city_access',
            ],
            [
                'id'    => 88,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
