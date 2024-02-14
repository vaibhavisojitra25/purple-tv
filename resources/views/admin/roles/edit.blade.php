@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="{{ asset('assets/plugins/treejs/tree.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/roles/roles.js') }}"></script>
<script>
    var data = [{
        id: 'Dashboard',
        text: 'Dashboard',
        children: [{
            id: 'View Dashboard',
            text: 'View Dashboard'
            }
        ]
        },
        {
        id: 'Profile',
        text: 'Profile',
        children: [{
            id: 'Manage Profile',
            text: 'Manage Profile'
            }
        ]
        },
        {
        id: 'Notification',
        text: 'Notification',
        children: [
            {
            id: 'View Notification',
            text: 'View Notification'
            },
            {
            id: 'Send Notification',
            text: 'Send Notification'
            },
            {
            id: 'Delete Notification',
            text: 'Delete Notification'
            },
        ]
        },
        {
        id: 'Announcement',
        text: 'Announcement',
        children: [
            {
            id: 'View Announcement',
            text: 'View Announcement'
            },
            {
            id: 'Add Announcement',
            text: 'Add Announcement'
            },
            {
            id: 'Delete Announcement',
            text: 'Delete Announcement'
            }
        ]
        },
        {
        id: 'Users',
        text: 'Users',
        children: [
            {
            id: 'View Users',
            text: 'View Users'
            },
            {
            id: 'Create Users',
            text: 'Create Users'
            },
            {
            id: 'Edit Users',
            text: 'Edit Users'
            },
            {
            id: 'Delete Users',
            text: 'Delete Users'
            },
            {
            id: 'Active Deactive Users',
            text: 'Active Deactive Users'
            },
        ]
        },
        {
        id: 'Apps',
        text: 'Apps',
        children: [
            {
            id: 'View App',
            text: 'View App',
            },
            {
            id: 'Create App',
            text: 'Create App',
            },
            {
            id: 'Edit App',
            text: 'Edit App',
            },
            {
            id: 'Delete App',
            text: 'Delete App',
            },
            {
            id: 'Manage App',
            text: 'Manage App',
            }
        ]
        },
        {
        id: 'VPN',
        text: 'VPN',
        children: [
            {
            id: 'View VPN',
            text: 'View VPN'
            },
            {
            id: 'Create VPN',
            text: 'Create VPN'
            },
            {
            id: 'Edit VPN',
            text: 'Edit VPN'
            },
            {
            id: 'Delete VPN',
            text: 'Delete VPN'
            }
        ]
        },
        {
        id: 'Plugins',
        text: 'Plugins',
        children: [
            {
            id: 'View Plugin',
            text: 'View Plugin'
            },
            {
            id: 'Create Plugin',
            text: 'Create Plugin'
            },
            {
            id: 'Edit Plugin',
            text: 'Edit Plugin'
            },
            {
            id: 'Delete Plugin',
            text: 'Delete Plugin'
            }
        ]
        },
        {
        id: 'Role',
        text: 'Role',
        children: [{
            id: 'View Role',
            text: 'View Role'
            },
            {
            id: 'Create Role',
            text: 'Create Role'
            },
            {
            id: 'Edit Role',
            text: 'Edit Role'
            },
            {
            id: 'Delete Role',
            text: 'Delete Role'
            }
        ]
        }
    ];

    var tree = new Tree('.tree-container', {
        data: [{
            id: 'Permissions',
            text: 'Permissions',
            children: data
        }],
        loaded: function () {
            this.values = JSON.parse('{!! json_encode($permissions) !!}');
        }
    });
</script>
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">Role</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('roles.index')}}">Roles</a></li>
            <li class="breadcrumb-item active">Edit Role</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>Edit Role</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('roles.update', $role->id)}}" id="roleForm" novalidate>
                        @csrf
                        @method('PUT')
                        <div class="form-row">
                            <div class="form-group col-12">
                                <label for="name">Name *</label>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $role->name }}"
                                    required>
                            </div>
                            <div class="tree-container"></div>
                        </div>
                        <div class="text-left">
                            <button class="btn btn-success mr-2">Save</button>
                            <a href="{{ route('roles.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
