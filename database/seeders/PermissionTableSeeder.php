<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-show',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'permission-show',
            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'dashboard',
            'admin-dashboard',
            'user-management',
            'customer-management',
            'customer-show',
            'customer-list',
            'customer-create',
            'customer-edit',
            'customer-delete',
            'product-management',
            'product-show',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'sale-management',
            'estimate-show',
            'estimate-list',
            'estimate-create',
            'estimate-edit',
            'estimate-delete',
            'invoice-show',
            'invoice-list',
            'invoice-create',
            'invoice-edit',
            'invoice-delete',
            'leads-management',
            'leads-show',
            'leads-list',
            'leads-create',
            'leads-edit',
            'leads-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
