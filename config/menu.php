<?php

return [
    'sidebar' => [
        [
            'title' => 'Dashboard',
            'link'  => '/dashboard',
            'active' => 'dashboard',
            'icon'  => 'icon-fa icon-fa-dashboard',
            'can' => ['View Dashboard']
        ],
        [
            'title' => 'Profile',
            'link'  => 'profile',
            'active' => 'profile*',
            'icon'  => 'icon-fa icon-fa-address-card',
            'can' => ['Manage Profile']
        ],
        [
            'title' => 'Notification',
            'link'  => 'notification',
            'active' => 'notification*',
            'icon'  => 'icon-fa icon-fa-bell',
            'can' => ['View Notification', 'Send Notification', 'Delete Notification']
        ],
        [
            'title' => 'Announcement',
            'link'  => 'announcement',
            'active' => 'announcement*',
            'icon'  => 'icon-fa icon-fa-bullhorn',
            'can' => ['View Announcement', 'Add Announcement', 'Delete Announcement']
        ],
        [
            'title' => 'Users',
            'link'  => 'users',
            'active' => 'users*',
            'icon'  => 'icon-fa icon-fa-users',
            'can' => ['View Users', 'Create Users', 'Edit Users', 'Delete Users', 'Active Deactive Users'],
        ],
        [
            'title' => 'Apps',
            'link'  => 'apps',
            'active' => 'apps*',
            'icon'  => 'icon-fa icon-fa-television',
            'can' => ['View App', 'Create App', 'Edit App', 'Delete App', 'Manage App']
        ],
        [
            'title' => 'VPN',
            'link'  => 'vpns',
            'active' => 'vpns*',
            'icon'  => 'icon-fa icon-fa-shield',
            'can' => ['View VPN', 'Create VPN', 'Edit VPN', 'Delete VPN']
        ],
        [
            'title' => 'Plugins',
            'link'  => 'plugins',
            'active' => 'plugins*',
            'icon'  => 'icon-fa icon-fa-puzzle-piece',
            'can' => ['View Plugin', 'Create Plugin', 'Edit Plugin', 'Delete Plugin']
        ],
        [
            'title' => 'Roles',
            'link'  => 'roles',
            'active' => 'roles*',
            'icon'  => 'icon-fa icon-fa-list',
            'can' => ['View Role', 'Create Role', 'Edit Role', 'Delete Role']
        ]
    ]
];
