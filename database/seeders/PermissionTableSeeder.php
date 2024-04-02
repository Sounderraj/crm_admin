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
            'profile-show',
            'profile-list',
            'profile-create',
            'profile-edit',
            'profile-delete',
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
            'salesorder-show',
            'salesorder-list',
            'salesorder-create',
            'salesorder-edit',
            'salesorder-delete',
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
            'settings',
            'organization-show',
            'organization-list',
            'organization-create',
            'organization-edit',
            'organization-delete',
            'taxrates-show',
            'taxrates-list',
            'taxrates-create',
            'taxrates-edit',
            'taxrates-delete',
            'taxrates-default-setup-update',
            'currency-show',
            'currency-list',
            'currency-create',
            'currency-edit',
            'currency-delete',
            'placeofsupply-show',
            'placeofsupply-list',
            'placeofsupply-create',
            'placeofsupply-edit',
            'placeofsupply-delete',
            'purchase-management',
            'vendors-show',
            'vendors-list',
            'vendors-create',
            'vendors-edit',
            'vendors-delete',
            'purchaseorder-show',
            'purchaseorder-list',
            'purchaseorder-create',
            'purchaseorder-edit',
            'purchaseorder-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
