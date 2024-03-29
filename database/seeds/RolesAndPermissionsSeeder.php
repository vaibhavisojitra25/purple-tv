<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            "View Dashboard",
            "Manage Profile",
            "View Notification",
            "Send Notification",
            "Delete Notification",
            "View Announcement",
            "Add Announcement",
            "Delete Announcement",
            "View Users",
            "Create Users",
            "Edit Users",
            "Delete Users",
            "Active Deactive Users",
            "View App",
            "Create App",
            "Edit App",
            "Delete App",
            "Manage App",
            "Accept Reject App",
            "Send Push Notification",
            "Update Push Notification Settings",
            "View In-App Announcement",
            "Create In-App Announcement",
            "Edit In-App Announcement",
            "Delete In-App Announcement",
            "View DNS",
            "Create DNS",
            "Edit DNS",
            "Delete DNS",
            "View Private Menu",
            "Create Private Menu",
            "Edit Private Menu",
            "Delete Private Menu",
            "View App Images",
            "Update App Wide Logo",
            "Update TV Banner Image",
            "Update Mobile Icon Image",
            "Update Background Image",
            "Update Splash Screen Image",
            "Update Remote Image",
            "View App Version",
            "Update App Version",
            "View App Player",
            "Update App Player",
            "View App Users",
            "View About Us",
            "Update About Us",
            "View Support",
            "Update Support",
            "View VPN Config",
            "Update VPN Config",
            "View App Endpoint",
            "Update App Endpoint",
            "View API Key",
            "Update API Key",
            "View Theme",
            "Update Theme",
            "View Background",
            "Update Background",
            "View Ads Config",
            "Update Ads Config",
            "Manage App Setting",
            "View App Configuration",
            "Update App Configuration",
            "View Language",
            "Update Language",
            "View URL",
            "Update URL",
            "View General Setting",
            "Update General Setting",
            "View App Settings",
            "Update App Settings",
            "View Theme Settings",
            "Update Theme Settings",
            "View Sub User Profile",
            "Update Sub User Profile",
            "View Device Type",
            "Update Device Type",
            "View Ticker Setting",
            "Update Ticker Setting",
            "View Play Setting",
            "Update Play Setting",
            "View Default Device",
            "Update Default Device",
            "View 4k Setting",
            "Update 4k Setting",
            "View Private Setting",
            "Update Private Setting",
            "View In-App Purchase",
            "Update In-App Purchase",
            "View Channel Reporting",
            "Update Channel Reporting",
            "View Movie Show Request",
            "Update Movie Show Request",
            "View Report Issue Email",
            "Update Report Issue Email",
            "View MQTT Setting",
            "Update MQTT Setting",
            "View Header Setting",
            "Update Header Setting",
            "View SMTP Setting",
            "Update SMTP Setting",
            "View Weather Setting",
            "Update Weather Setting",
            "View EPG Setting",
            "Update EPG Setting",
            "View Recording Setting",
            "Update Recording Setting",
            "View Cloud Setting",
            "Update Cloud Setting",
            "View P2P Setting",
            "Update P2P Setting",
            "View Stream Setting",
            "Update Stream Setting",
            "View VPN",
            "Create VPN",
            "Edit VPN",
            "Delete VPN",
            "View Plugin",
            "Create Plugin",
            "Edit Plugin",
            "Delete Plugin",
            "View Role",
            "Create Role",
            "Edit Role",
            "Delete Role",
        ];

        // create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign created permissions
        $superAdmin = Role::create(['name' => 'SuperAdmin']);
        $superAdmin->syncPermissions(Permission::all());

        $support = Role::create(['name' => 'Support']);
        $support->syncPermissions([
            "View Dashboard",
            "Manage Profile",
            "View Notification",
            "Send Notification",
            "Delete Notification",
            "View Announcement",
            "Add Announcement",
            "Delete Announcement",
            "View Users",
            "Create Users",
            "Edit Users",
            "Delete Users",
            "Active Deactive Users",
            "View App",
            "Create App",
            "Edit App",
            "Delete App",
            "Manage App",
            "Accept Reject App",
            "Send Push Notification",
            "Update Push Notification Settings",
            "View In-App Announcement",
            "Create In-App Announcement",
            "Edit In-App Announcement",
            "Delete In-App Announcement",
            "View DNS",
            "Create DNS",
            "Edit DNS",
            "Delete DNS",
            "View Private Menu",
            "Create Private Menu",
            "Edit Private Menu",
            "Delete Private Menu",
            "View App Images",
            "Update App Wide Logo",
            "Update TV Banner Image",
            "Update Mobile Icon Image",
            "Update Background Image",
            "Update Splash Screen Image",
            "Update Remote Image",
            "View App Version",
            "Update App Version",
            "View App Player",
            "Update App Player",
            "View App Users",
            "View About Us",
            "Update About Us",
            "View Support",
            "Update Support",
            "View VPN Config",
            "Update VPN Config",
            "View App Endpoint",
            "Update App Endpoint",
            "View API Key",
            "Update API Key",
            "View Theme",
            "Update Theme",
            "View Background",
            "Update Background",
            "View Ads Config",
            "Update Ads Config",
            "Manage App Setting",
            "View App Configuration",
            "Update App Configuration",
            "View Language",
            "Update Language",
            "View URL",
            "Update URL",
            "View General Setting",
            "Update General Setting",
            "View App Settings",
            "Update App Settings",
            "View Theme Settings",
            "Update Theme Settings",
            "View Sub User Profile",
            "Update Sub User Profile",
            "View Device Type",
            "Update Device Type",
            "View Ticker Setting",
            "Update Ticker Setting",
            "View Play Setting",
            "Update Play Setting",
            "View Default Device",
            "Update Default Device",
            "View 4k Setting",
            "Update 4k Setting",
            "View Private Setting",
            "Update Private Setting",
            "View In-App Purchase",
            "Update In-App Purchase",
            "View Channel Reporting",
            "Update Channel Reporting",
            "View Movie Show Request",
            "Update Movie Show Request",
            "View Report Issue Email",
            "Update Report Issue Email",
            "View MQTT Setting",
            "Update MQTT Setting",
            "View Header Setting",
            "Update Header Setting",
            "View SMTP Setting",
            "Update SMTP Setting",
            "View Weather Setting",
            "Update Weather Setting",
            "View EPG Setting",
            "Update EPG Setting",
            "View Recording Setting",
            "Update Recording Setting",
            "View Cloud Setting",
            "Update Cloud Setting",
            "View P2P Setting",
            "Update P2P Setting",
            "View Stream Setting",
            "Update Stream Setting",
            "View VPN",
            "Create VPN",
            "Edit VPN",
            "Delete VPN",
            "View Plugin",
            "Create Plugin",
            "Edit Plugin",
            "Delete Plugin"
        ]);

        $user = Role::create(['name' => 'User']);
        $user->syncPermissions(["View Dashboard", "Manage Profile"]);
    }
}
