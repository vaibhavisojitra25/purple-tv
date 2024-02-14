@extends('admin.layouts.layout-basic')

@section('scripts')
<script src="{{ asset('assets/plugins/treejs/tree.min.js') }}"></script>
<script>
    var data = [
        {
        id: 'Configure App',
        text: 'Configure App',
        children: [{
            id: 'Push Notification',
            text: 'Push Notification',
            children: [{
                id: 'Send Push Notification',
                text: 'Send Push Notification',
                },
                {
                id: 'Update Push Notification Settings',
                text: 'Update Push Notification Settings',
                },
            ]
            },
            {
            id: 'In-App Announcement',
            text: 'In-App Announcement',
            children: [{
                id: 'View In-App Announcement',
                text: 'View In-App Announcement'
                },
                {
                id: 'Create In-App Announcement',
                text: 'Create In-App Announcement'
                },
                {
                id: 'Edit In-App Announcement',
                text: 'Edit In-App Announcement'
                },
                {
                id: 'Delete In-App Announcement',
                text: 'Delete In-App Announcement'
                },
            ]
            },
            {
            id: 'DNS',
            text: 'DNS',
            children: [{
                id: 'View DNS',
                text: 'View DNS'
                },
                {
                id: 'Create DNS',
                text: 'Create DNS'
                },
                {
                id: 'Edit DNS',
                text: 'Edit DNS'
                },
                {
                id: 'Delete DNS',
                text: 'Delete DNS'
                },
            ]
            },
            {
            id: 'Private Menu',
            text: 'Private Menu',
            children: [{
                id: 'View Private Menu',
                text: 'View Private Menu'
                },
                {
                id: 'Create Private Menu',
                text: 'Create Private Menu'
                },
                {
                id: 'Edit Private Menu',
                text: 'Edit Private Menu'
                },
                {
                id: 'Delete Private Menu',
                text: 'Delete Private Menu'
                },
            ]
            },
            {
            id: 'App Image',
            text: 'App Image',
            children: [{
                id: 'View App Images',
                text: 'View App Images'
                },
                {
                id: 'Update App Wide Logo',
                text: 'Update App Wide Logo'
                },
                {
                id: 'Update TV Banner Image',
                text: 'Update TV Banner Image'
                },
                {
                id: 'Update Mobile Icon Image',
                text: 'Update Mobile Icon Image'
                },
                {
                id: 'Update Background Image',
                text: 'Update Background Image'
                },
                {
                id: 'Update Splash Screen Image',
                text: 'Update Splash Screen Image'
                },
                {
                id: 'Update Remote Image',
                text: 'Update Remote Image'
                },
            ]
            },
            {
            id: 'App Version',
            text: 'App Version',
            children: [{
                id: 'View App Version',
                text: 'View App Version'
                },
                {
                id: 'Update App Version',
                text: 'Update App Version'
                }
            ]
            },
            {
            id: 'App Player',
            text: 'App Player',
            children: [{
                id: 'View App Player',
                text: 'View App Player'
                },
                {
                id: 'Update App Player',
                text: 'Update App Player'
                }
            ]
            },
            {
            id: 'App Users',
            text: 'App Users',
            children: [{
                id: 'View App Users',
                text: 'View App Users'
            }]
            },
            {
            id: 'About Us',
            text: 'About Us',
            children: [{
                id: 'View About Us',
                text: 'View About Us'
                },
                {
                id: 'Update About Us',
                text: 'Update About Us'
                }
            ]
            },
            {
            id: 'Support',
            text: 'Support',
            children: [{
                id: 'View Support',
                text: 'View Support'
                },
                {
                id: 'Update Support',
                text: 'Update Support'
                }
            ]
            },
            {
            id: 'VPN Config',
            text: 'VPN Config',
            children: [{
                id: 'View VPN Config',
                text: 'View VPN Config'
                },
                {
                id: 'Update VPN Config',
                text: 'Update VPN Config'
                }
            ]
            },
            {
            id: 'App Endpoint',
            text: 'App Endpoint',
            children: [{
                id: 'View App Endpoint',
                text: 'View App Endpoint'
                },
                {
                id: 'Update App Endpoint',
                text: 'Update App Endpoint'
                }
            ]
            },
            {
            id: 'API Key',
            text: 'API Key',
            children: [{
                id: 'View API Key',
                text: 'View API Key'
                },
                {
                id: 'Update API Key',
                text: 'Update API Key'
                }
            ]
            },
            {
            id: 'Appearance',
            text: 'Appearance',
            children: [{
                id: 'Theme',
                text: 'Theme',
                children: [{
                    id: 'View Theme',
                    text: 'View Theme'
                    },
                    {
                    id: 'Update Theme',
                    text: 'Update Theme'
                    }
                ]
                },
                {
                id: 'Background',
                text: 'Background',
                children: [{
                    id: 'View Background',
                    text: 'View Background'
                    },
                    {
                    id: 'Update Background',
                    text: 'Update Background'
                    }
                ]
                }
            ]
            },
            {
            id: 'Ads Config',
            text: 'Ads Config',
            children: [{
                id: 'View Ads Config',
                text: 'View Ads Config'
                },
                {
                id: 'Update Ads Config',
                text: 'Update Ads Config'
                }
            ]
            },
            {
            id: 'App Setting',
            text: 'App Setting',
            children: [{
                id: "Manage App Setting",
                text: "Manage App Setting",
                },
                {
                id: 'App Configuration',
                text: 'App Configuration',
                children: [{
                    id: 'View App Configuration',
                    text: 'View App Configuration'
                    },
                    {
                    id: 'Update App Configuration',
                    text: 'Update App Configuration'
                    }
                ]
                },
                {
                id: 'Language',
                text: 'Language',
                children: [{
                    id: 'View Language',
                    text: 'View Language'
                    },
                    {
                    id: 'Update Language',
                    text: 'Update Language'
                    }
                ]
                },
                {
                id: 'URL',
                text: 'URL',
                children: [{
                    id: 'View URL',
                    text: 'View URL'
                    },
                    {
                    id: 'Update URL',
                    text: 'Update URL'
                    }
                ]
                },
                {
                id: 'General Setting',
                text: 'General Setting',
                children: [{
                    id: 'View General Setting',
                    text: 'View General Setting'
                    },
                    {
                    id: 'Update General Setting',
                    text: 'Update General Setting'
                    }
                ]
                },
                {
                id: 'App Settings',
                text: 'App Settings',
                children: [{
                    id: 'View App Settings',
                    text: 'View App Settings'
                    },
                    {
                    id: 'Update App Settings',
                    text: 'Update App Settings'
                    }
                ]
                },
                {
                id: 'Theme Settings',
                text: 'Theme Settings',
                children: [{
                    id: 'View Theme Settings',
                    text: 'View Theme Settings'
                    },
                    {
                    id: 'Update Theme Settings',
                    text: 'Update Theme Settings'
                    }
                ]
                },
                {
                id: 'Sub User Profile',
                text: 'Sub User Profile',
                children: [{
                    id: 'View Sub User Profile',
                    text: 'View Sub User Profile'
                    },
                    {
                    id: 'Update Sub User Profile',
                    text: 'Update Sub User Profile'
                    }
                ]
                },
                {
                id: 'Device Type',
                text: 'Device Type',
                children: [{
                    id: 'View Device Type',
                    text: 'View Device Type'
                    },
                    {
                    id: 'Update Device Type',
                    text: 'Update Device Type'
                    }
                ]
                },
                {
                id: 'Ticker Setting',
                text: 'Ticker Setting',
                children: [{
                    id: 'View Ticker Setting',
                    text: 'View Ticker Setting'
                    },
                    {
                    id: 'Update Ticker Setting',
                    text: 'Update Ticker Setting'
                    }
                ]
                },
                {
                id: 'Play Setting',
                text: 'Play Setting',
                children: [{
                    id: 'View Play Setting',
                    text: 'View Play Setting'
                    },
                    {
                    id: 'Update Play Setting',
                    text: 'Update Play Setting'
                    }
                ]
                },
                {
                id: 'Default Device',
                text: 'Default Device',
                children: [{
                    id: 'View Default Device',
                    text: 'View Default Device'
                    },
                    {
                    id: 'Update Default Device',
                    text: 'Update Default Device'
                    }
                ]
                },
                {
                id: '4k Setting',
                text: '4k Setting',
                children: [{
                    id: 'View 4k Setting',
                    text: 'View 4k Setting'
                    },
                    {
                    id: 'Update 4k Setting',
                    text: 'Update 4k Setting'
                    }
                ]
                },
                {
                id: 'Private Setting',
                text: 'Private Setting',
                children: [{
                    id: 'View Private Setting',
                    text: 'View Private Setting'
                    },
                    {
                    id: 'Update Private Setting',
                    text: 'Update Private Setting'
                    }
                ]
                },
                {
                id: 'In-App Purchase',
                text: 'In-App Purchase',
                children: [{
                    id: 'View In-App Purchase',
                    text: 'View In-App Purchase'
                    },
                    {
                    id: 'Update In-App Purchase',
                    text: 'Update In-App Purchase'
                    }
                ]
                },
                {
                id: 'Channel Reporting',
                text: 'Channel Reporting',
                children: [{
                    id: 'View Channel Reporting',
                    text: 'View Channel Reporting'
                    },
                    {
                    id: 'Update Channel Reporting',
                    text: 'Update Channel Reporting'
                    }
                ]
                },
                {
                id: 'Movie Show Request',
                text: 'Movie Show Request',
                children: [{
                    id: 'View Movie Show Request',
                    text: 'View Movie Show Request'
                    },
                    {
                    id: 'Update Movie Show Request',
                    text: 'Update Movie Show Request'
                    }
                ]
                },
                {
                id: 'Report Issue Email',
                text: 'Report Issue Email',
                children: [{
                    id: 'View Report Issue Email',
                    text: 'View Report Issue Email'
                    },
                    {
                    id: 'Update Report Issue Email',
                    text: 'Update Report Issue Email'
                    }
                ]
                },
                {
                id: 'MQTT Setting',
                text: 'MQTT Setting',
                children: [{
                    id: 'View MQTT Setting',
                    text: 'View MQTT Setting'
                    },
                    {
                    id: 'Update MQTT Setting',
                    text: 'Update MQTT Setting'
                    }
                ]
                },
                {
                id: 'Header Setting',
                text: 'Header Setting',
                children: [{
                    id: 'View Header Setting',
                    text: 'View Header Setting'
                    },
                    {
                    id: 'Update Header Setting',
                    text: 'Update Header Setting'
                    }
                ]
                },
                {
                id: 'SMTP Setting',
                text: 'SMTP Setting',
                children: [{
                    id: 'View SMTP Setting',
                    text: 'View SMTP Setting'
                    },
                    {
                    id: 'Update SMTP Setting',
                    text: 'Update SMTP Setting'
                    }
                ]
                },
                {
                id: 'Weather Setting',
                text: 'Weather Setting',
                children: [{
                    id: 'View Weather Setting',
                    text: 'View Weather Setting'
                    },
                    {
                    id: 'Update Weather Setting',
                    text: 'Update Weather Setting'
                    }
                ]
                },
                {
                id: 'EPG Setting',
                text: 'EPG Setting',
                children: [{
                    id: 'View EPG Setting',
                    text: 'View EPG Setting'
                    },
                    {
                    id: 'Update EPG Setting',
                    text: 'Update EPG Setting'
                    }
                ]
                },
                {
                id: 'Recording Setting',
                text: 'Recording Setting',
                children: [{
                    id: 'View Recording Setting',
                    text: 'View Recording Setting'
                    },
                    {
                    id: 'Update Recording Setting',
                    text: 'Update Recording Setting'
                    }
                ]
                },
                {
                id: 'Cloud Setting',
                text: 'Cloud Setting',
                children: [{
                    id: 'View Cloud Setting',
                    text: 'View Cloud Setting'
                    },
                    {
                    id: 'Update Cloud Setting',
                    text: 'Update Cloud Setting'
                    }
                ]
                },
                {
                id: 'P2P Setting',
                text: 'P2P Setting',
                children: [{
                    id: 'View P2P Setting',
                    text: 'View P2P Setting'
                    },
                    {
                    id: 'Update P2P Setting',
                    text: 'Update P2P Setting'
                    }
                ]
                },
                {
                id: 'Stream Setting',
                text: 'Stream Setting',
                children: [{
                    id: 'View Stream Setting',
                    text: 'View Stream Setting'
                    },
                    {
                    id: 'Update Stream Setting',
                    text: 'Update Stream Setting'
                    }
                ]
                },
            ]
            },
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

    $('#permissionForm').on('submit', function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = form.serializeArray();
        var jsonData = {};
        formData.push({
        name: 'permissions',
        value: tree.values
        });
        $.each(formData, function (i, field) {
        jsonData[field.name] = field.value || ''
        });
        if (form.valid()) {
        $.ajax({
            url: url,
            method: 'POST',
            data: JSON.stringify(jsonData),
            contentType: 'application/json',
            success: function (response) {
            if (response.success) {
                toastr.success(response.message);
                setTimeout(() => {
                location.reload();
                }, 500);
            } else {
                toastr.warning(response.message);
            }
            },
            error: function (error) {
            toastr.error('Something went wrong.');
            }
        });
        }
    });
</script>
@stop

@section('content')
<div class="main-content">
    <div class="page-header">
        <h3 class="page-title">App Permissions</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('apps.index')}}">Apps</a></li>
            <li class="breadcrumb-item active">App Permissions</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12 col-md-6">
            <div class="card">
                <div class="card-header">
                    <h6>{{ $app->app_name }}</h6>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('apppermissions.update', $app->id)}}" id="permissionForm"
                        novalidate>
                        @csrf
                        @method('PUT')
                        <div class="tree-container"></div>
                        <hr>
                        <div class="text-left">
                            <button class="btn btn-success mr-2">Save</button>
                            <a href="{{ route('apps.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop