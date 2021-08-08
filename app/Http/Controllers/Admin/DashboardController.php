<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
     Table,
     User,
     Category,
     Product,
     Plan,
     Role,
     Permission,
     Tenant,
     Profile
};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
     public function home(){
          $tenant = auth()->user()->tenant;
          $totalUsers = User::where('tenant_id', $tenant->id)->count();
          $totalTables = Table::count();
          $totalCategories = Category::count();
          $totalTenants = Tenant::count();
          $totalProducts = Product::count();
          $totalPlans =  Plan::count();
          $totalRoles = Role::count();
          $totalProfiles = Profile::count();
          $totalPermissions = Permission::count();

          return view('admin.pages.home.home', compact('totalUsers', 'totalTables',
           'totalCategories',
            'totalTenants', 'totalProfiles', 'totalProducts', 'totalPlans', 'totalRoles', 'totalPermissions'));
     }
}
