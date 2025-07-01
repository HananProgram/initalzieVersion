<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'مدير النظام',
                'description' => 'مدير النظام مع جميع الصلاحيات',
                'permissions' => [
                    'users_create', 'users_update', 'users_view', 'users_delete',
                    'agencies_create', 'agencies_update', 'agencies_view', 'agencies_delete',
                    'services_create', 'services_update', 'services_view', 'services_delete',
                    'customers_create', 'customers_update', 'customers_view', 'customers_delete',
                    'roles_create', 'roles_update', 'roles_view', 'roles_delete',
                    'bookings_create', 'bookings_update', 'bookings_view', 'bookings_delete',
                    'providers_create', 'providers_update', 'providers_view', 'providers_delete',
                    'intermediaries_create', 'intermediaries_update', 'intermediaries_view', 'intermediaries_delete',
                    'accounts_create', 'accounts_update', 'accounts_view', 'accounts_delete',
                    'service_types_create', 'service_types_update', 'service_types_view', 'service_types_delete',
                    'manage_agencies', 'manage_users', 'manage_roles', 'view_reports', 'manage_system_settings', 'manage_bookings', 'manage_customers', 'manage_packages', 'manage_flights', 'manage_hotels',
                ]
            ],
            [
                'name' => 'agency_admin',
                'display_name' => 'مدير الوكالة',
                'description' => 'مدير وكالة السفر مع صلاحيات إدارة الوكالة',
                'permissions' => [
                    'users_create', 'users_update', 'users_view', 'users_delete',
                    'agencies_view',
                    'services_create', 'services_update', 'services_view', 'services_delete',
                    'customers_create', 'customers_update', 'customers_view', 'customers_delete',
                    'roles_create', 'roles_update', 'roles_view',
                    'bookings_create', 'bookings_update', 'bookings_view', 'bookings_delete',
                    'providers_create', 'providers_update', 'providers_view', 'providers_delete',
                    'intermediaries_create', 'intermediaries_update', 'intermediaries_view', 'intermediaries_delete',
                    'accounts_view',
                    'service_types_view',
                    'manage_agency_users', 'manage_agency_settings', 'view_agency_reports',
                ]
            ],
            [
                'name' => 'booking_manager',
                'display_name' => 'مدير الحجوزات',
                'description' => 'مدير الحجوزات في الوكالة',
                'permissions' => [
                    'bookings_create', 'bookings_update', 'bookings_view', 'bookings_delete',
                    'customers_view',
                    'services_view',
                    'providers_view',
                    'intermediaries_view',
                    'accounts_view',
                    'service_types_view',
                ]
            ],
            [
                'name' => 'customer_service',
                'display_name' => 'خدمة العملاء',
                'description' => 'موظف خدمة العملاء',
                'permissions' => [
                    'bookings_view',
                    'customers_create', 'customers_update', 'customers_view', 'customers_delete',
                    'services_view',
                    'providers_view',
                    'intermediaries_view',
                    'accounts_view',
                    'service_types_view',
                ]
            ],
            [
                'name' => 'sales_agent',
                'display_name' => 'مندوب المبيعات',
                'description' => 'مندوب مبيعات في الوكالة',
                'permissions' => [
                    'bookings_create', 'bookings_view',
                    'customers_view',
                    'services_view',
                    'providers_view',
                    'intermediaries_view',
                    'accounts_view',
                    'service_types_view',
                ]
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
