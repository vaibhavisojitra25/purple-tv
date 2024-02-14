@extends('admin.layouts.layout-basic')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.css"
    rel="stylesheet">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link type="text/css" rel="stylesheet" href="{{ asset('assets/plugins/image-uploader/image-uploader.min.css') }}">
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.js"></script>
<script src="{{ asset('assets/plugins/image-uploader/image-uploader.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.validator.addMethod('filesize', function (value, element, arg) {
        if(element.files[0].size<=arg){
            return true;
        }else{
            return false;
        }
    });

    $(function () {
        $('.colorpicker').colorpicker();
        $(".nav-tabs li:first > a").addClass("active");
        $(".tab-content > .tab-pane:first").addClass("show active");
        $('.input-background-images').imageUploader({
            preloaded: JSON.parse('{!! $backgroundImages !!}'),
            imagesInputName: 'background_images',
            preloadedInputName: 'old_background_images',
            extensions: ['.jpg', '.jpeg', '.png'],
            mimes: ['image/jpeg', 'image/png'],
            maxSize: 2 * 1024 * 1024,
            maxFiles: 10
        });
    });

    function publishApp(appCode) {
        $.ajax({
            url: 'http://appi.purplesmarttv.com/clearcdn.php',
            method: 'POST',
            data: {code: appCode},
            contentType: 'Application/Json',
            success: function (response) {
                toastr.success("Published Successfully.");
            },
            error: function (error) {
                toastr.error('Something went wrong.');
            }
        });
    }
</script>

@if(auth()->user()->can('Update Background') || $app->hasPermissionTo('Update Background'))
<script>
    $("#backgroundForm").validate().settings.ignore = "*";
</script>
@endif

@if(auth()->user()->can('View In-App Announcement') || $app->hasPermissionTo('View In-App Announcement'))
<script>
    var announcementTable = $('#announcementsDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('inappannouncement.index')}}"+"?app_id="+"{{$app->id}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'title', name: 'title', sClass: "align-middle table-image"},
            {data: 'short_description', name: 'short_description', sClass: "align-middle"},
            {data: 'image', name: 'image', sClass: "align-middle", orderable: false, searchable: false},
            {data: 'status', name: 'status', sClass: "align-middle"},
            {data: 'sent_users', name: 'sent_users', sClass: "align-middle"},
            {data: 'received_users', name: 'received_users', sClass: "align-middle"},
            {data: 'click_users', name: 'click_users', sClass: "align-middle"},
            {data: 'action', name: 'action', sClass: "align-middle no-wrap", orderable: false, searchable: false},
        ],
        // responsive: true
    });
</script>
@endif

@if(auth()->user()->can('View DNS') || $app->hasPermissionTo('View DNS'))
<script>
    var dnsTable = $('#dnsDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('dnsurl.index')}}"+"?app_id="+"{{$app->id}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'dns_title', name: 'dns_title', sClass: "align-middle table-image"},
            {data: 'url', name: 'url', sClass: "align-middle table-image"},
            {data: 'live_dns', name: 'live_dns', sClass: "align-middle table-image"},
            {data: 'epg_dns', name: 'epg_dns', sClass: "align-middle table-image"},
            {data: 'movie_dns', name: 'movie_dns', sClass: "align-middle table-image"},
            {data: 'series_dns', name: 'series_dns', sClass: "align-middle table-image"},
            {data: 'catchup_dns', name: 'catchup_dns', sClass: "align-middle table-image"},
            {data: 'action', name: 'action', sClass: "align-middle no-wrap", orderable: false, searchable: false},
        ],
        // responsive: true
    });
</script>
@endif

@if(auth()->user()->can('View Private Menu') || $app->hasPermissionTo('View Private Menu'))
<script>
    var menuTable = $('#menuDatatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('appmenu.index')}}"+"?app_id="+"{{$app->id}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'addtion_app_name', name: 'addtion_app_name', sClass: "align-middle table-image"},
            {data: 'addtion_app_icon', name: 'addtion_app_icon', sClass: "align-middle table-image", orderable: false, searchable: false},
            {data: 'addtion_app_pkg', name: 'addtion_app_pkg', sClass: "align-middle table-image"},
            {data: 'addtion_app_url', name: 'addtion_app_url', sClass: "align-middle table-image"},
            {data: 'addtion_app_status', name: 'addtion_app_status', sClass: "align-middle table-image"},
            {data: 'action', name: 'action', sClass: "align-middle no-wrap", orderable: false, searchable: false},
        ],
        // responsive: true
    });
</script>
@endif

@if(auth()->user()->can('View App Users') || $app->hasPermissionTo('View App Users'))
<script>
    var appUsersTable = $('#appUsersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('appuser.index')}}"+"?app_id="+"{{$app->id}}",
        },
        columns: [
            {data: 'DT_RowIndex', name: 'index_column', sClass: "align-middle table-image", searchable: false},
            {data: 'full_name', name: 'full_name', sClass: "align-middle table-image"},
            {data: 'email', name: 'email', sClass: "align-middle table-image"},
            {data: 'username', name: 'username', sClass: "align-middle table-image"},
            {data: 'status', name: 'status', sClass: "align-middle table-image"},
            {data: 'created_at', name: 'created_at', sClass: "align-middle table-image"},
        ],
        // responsive: true
    });
</script>
@endif

<script>
    $('#announcementForm').validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: '',
        rules: {
            title: {
                required: true,
            },
            short_description: {
                required: true,
            },
            image: {
                accept: "image/jpg,image/jpeg,image/png"
            }
        },
        messages: {
            title: {
                required: 'Please Enter Title',
            },
            short_description: {
                required: 'Please Enter Description',
            },
            image: {
                accept: 'Allows only jpg, jpeg and png file'
            }
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group .form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element)
            .closest('.form-group .form-control').removeClass('is-invalid')
            .closest('.form-group .form-control').addClass('is-valid');
        },
        success: function (label) {
            label
            .closest('.form-group .form-control').removeClass('is-invalid');
        }
    });

    $('.app-image-form').validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: '',
        rules: {
            app_image: {
                required: true,
                accept: "image/jpg,image/jpeg,image/png"
            }
        },
        messages: {
            app_image: {
                required: 'Please Select Image',
                accept: 'Allows only jpg, jpeg and png file'
            }
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group .form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element)
            .closest('.form-group .form-control').removeClass('is-invalid')
            .closest('.form-group .form-control').addClass('is-valid');
        },
        success: function (label) {
            label
            .closest('.form-group .form-control').removeClass('is-invalid');
        }
    });

    $('#aboutUsForm').validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: '',
        rules: {
            app_name: {
                required: true,
            },
            description: {
                required: true,
            },
            developed_by: {
                required: true,
            },
            about_skype_id: {
                required: true,
            },
            about_telegram_no: {
                required: true,
            },
            about_whatsapp_no: {
                required: true,
            },
        },
        messages: {
            app_name: {
                required: 'Please Enter App Name',
            },
            description: {
                required: 'Please Enter Description',
            },
            developed_by: {
                required: 'Please Enter Developed By',
            },
            about_skype_id: {
                required: 'Please Enter Skype Id',
            },
            about_telegram_no: {
                required: 'Please Enter Telegram No',
            },
            about_whatsapp_no: {
                required: 'Please Enter Whatsapp No',
            },
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group .form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element)
            .closest('.form-group .form-control').removeClass('is-invalid')
            .closest('.form-group .form-control').addClass('is-valid');
        },
        success: function (label) {
            label
            .closest('.form-group .form-control').removeClass('is-invalid');
        }
    });

    $('#announcementForm').on('submit', function (e) {
        e.preventDefault();
        if ($(this).valid()) {
            $('#btnSaveAnnouncement').prop('disabled', true);
            var formData = new FormData($(this)[0]);
            $.ajax({
                url: '{{route("inappannouncement.store")}}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        announcementTable.ajax.reload();
                        $("#announcementForm")[0].reset();
                        $(".announcement-file-label").removeClass("selected").html('');
                        $('#viewAnnouncementImg').attr('src', '').addClass('d-none');
                    } else {
                        toastr.warning(response.message);
                    }
                    $('#btnSaveAnnouncement').prop('disabled', false);
                },
                error: function (error) {
                    $('#btnSaveAnnouncement').prop('disabled', false);
                    toastr.error('Something went wrong.');
                }
            });
        }
    });

    function editAnnouncement(announcement, url) {
        $('#announceId').val(announcement.id);
        $('#announceTitle').val(announcement.title);
        $('#shortDesc').val(announcement.short_description);
        if(announcement.image) {
            $('#viewAnnouncementImg').attr('src', url).removeClass('d-none');
        }
        if(announcement.status == 1) {
            changeSwitchery($('#announcementStatus'), true);
        } else {
            changeSwitchery($('#announcementStatus'), false);
        }
    }

    function deleteAnnouncement(url, token) {
        notie.confirm({
            text: 'Are you sure you want to delete?',
            submitText: 'Yes Delete It!',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: token
                    },
                    url: url,
                    success: function (data) {
                        toastr.success('Deleted Successfully');
                        announcementTable.ajax.reload();
                    },
                    error: function (data) {
                        toastr.error('Something went wrong');
                    }
                });
            }
        });
    }

    function editDnsUrl(dns) {
        $('#dnsUrl').val(dns.url);
        $('#dnsId').val(dns.id);
        $('#dnsTitle').val(dns.dns_title);
        $('#liveDns').val(dns.live_dns);
        $('#epgDns').val(dns.epg_dns);
        $('#movieDns').val(dns.movie_dns);
        $('#seriesDns').val(dns.series_dns);
        $('#catchupDns').val(dns.catchup_dns);
    }

    function editAppMenu(menu, iconUrl) {
        $('#menuId').val(menu.id);
        $('#addtionAppName').val(menu.addtion_app_name);
        $('#addtionAppPackageName').val(menu.addtion_app_pkg);
        $('#addtionAppUrl').val(menu.addtion_app_url);
        $('#viewAppMenuIcon').attr('src', iconUrl);
        $('#additionAppIcon').rules('remove', "required");
        if(menu.addtion_app_status == 1) {
            changeSwitchery($('#additionAppStatus'), true);
        } else {
            changeSwitchery($('#additionAppStatus'), false);
        }
    }

    function changeSwitchery(element, checked) {
        if ((element.is(':checked') && checked == false) || (!element.is(':checked') && checked == true)) {
            element.parent().find('.switchery').trigger('click');
        }
    }

    $('#dnsUrlForm').validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: '',
        rules: {
            url: {
                required: true,
                url: true
            },
            dns_title: {
                required: true,
            }
        },
        messages: {
            url: {
                required: 'Please Enter Url',
                url: 'Please Enter Valid URL'
            },
            dns_title: {
                required: 'Please Enter Dns Title',
            }
        },
        highlight: function (element) {
            $(element)
            .closest('.form-group .form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element)
            .closest('.form-group .form-control').removeClass('is-invalid')
            .closest('.form-group .form-control').addClass('is-valid');
        },
        success: function (label) {
            label
            .closest('.form-group .form-control').removeClass('is-invalid');
        }
    });

    $('#menuForm').validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: '',
        rules: {
            addtion_app_name: {
                required: true,
            },
            addtion_app_pkg: {
                required: true,
            },
            addtion_app_url: {
                required: true,
                url: true
            },
            addtion_app_icon: {
                required: true,
                accept: "image/jpg,image/jpeg,image/png"
            },
        },
        messages: {
            addtion_app_name: {
                required: 'Please Enter App Name',
            },
            addtion_app_pkg: {
                required: 'Please Enter Plackage Name',
            },
            addtion_app_url: {
                required: 'Please Enter App Url',
                url: 'Please Enter Valid Url'
            },
            addtion_app_icon: {
                required: 'Please Select App Icon',
                accept: 'Allows only jpg, jpeg and png file'
            },
        }
    });

    $('#dnsUrlForm').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        if (form.valid()) {
            $('#btnSaveDns').prop('disabled', true);
            $.ajax({
                url: '{{route("dnsurl.store")}}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#btnSaveDns').prop('disabled', false);
                    if (response.success) {
                        toastr.success(response.message);
                        dnsTable.ajax.reload();
                        $('#dnsUrl').val('');
                        $('#dnsId').val('');
                        $('#dnsTitle').val('');
                        $('#liveDns').val('');
                        $('#epgDns').val('');
                        $('#movieDns').val('');
                        $('#seriesDns').val('');
                        $('#catchupDns').val('');
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function (error) {
                    $('#btnSaveDns').prop('disabled', false);
                    toastr.error('Something went wrong.');
                }
            });
        }
    });

    $('#menuForm').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        if (form.valid()) {
            $('#btnSaveMenu').prop('disabled', true);
            $.ajax({
                url: '{{route("appmenu.store")}}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#btnSaveMenu').prop('disabled', false);
                    if (response.success) {
                        toastr.success(response.message);
                        menuTable.ajax.reload();
                        form[0].reset();
                        $(".menu-file-label").removeClass("selected").html('');
                        $('#viewAppMenuIcon').attr('src', '');
                    } else {
                        toastr.warning(response.message);
                    }
                },
                error: function (error) {
                    $('#btnSaveMenu').prop('disabled', false);
                    toastr.error('Something went wrong.');
                }
            });
        }
    });

    function deleteDnsUrl(url, token) {
        notie.confirm({
            text: 'Are you sure you want to delete?',
            submitText: 'Yes Delete It!',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: token
                    },
                    url: url,
                    success: function (data) {
                        toastr.success('Deleted Successfully');
                        dnsTable.ajax.reload();
                    },
                    error: function (data) {
                        toastr.error('Something went wrong');
                    }
                });
            }
        });
    }

    function deleteAppMenu(url, token) {
        notie.confirm({
            text: 'Are you sure you want to delete?',
            submitText: 'Yes Delete It!',
            cancelText: 'Cancel',
            submitCallback: function () {
                $.ajax({
                    type: 'POST',
                    data: {
                        _method: 'DELETE',
                        _token: token
                    },
                    url: url,
                    success: function (data) {
                        toastr.success('Deleted Successfully');
                        menuTable.ajax.reload();
                    },
                    error: function (data) {
                        toastr.error('Something went wrong');
                    }
                });
            }
        });
    }

    $(".custom-file-input").on("change", function () {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

        var target = $(this).attr('data-target');
        if(target) {
            var file = $(this).get(0).files[0];
            if (file) {
                var reader = new FileReader();
                reader.onload = function () {
                    $("#"+target).attr("src", reader.result);
                }
                reader.readAsDataURL(file);
            }
        }
    });

    $('#formAppVersion').validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: '',
        rules: {
            version_update_message: {
                required: true,
            },
            version_code: {
                required: true,
            },
            version_name: {
                required: true,
            },
            play_store_url: {
                required: true,
                url: true
            },
            apk_url: {
                required: true,
                url: true
            },
        },
        messages: {
            version_update_message: {
                required: 'Please Enter Version Update Message',
            },
            version_code: {
                required: 'Please Enter Version Code',
            },
            version_name: {
                required: 'Please Enter Version Name',
            },
            play_store_url: {
                required: 'Please Enter Play Store Url',
                url: 'Please Enter Valid Url'
            },
            apk_url: {
                required: 'Please Enter Apk Url',
                url: 'Please Enter Valid Url'
            },
        },
        highlight: function (element) {
            $(element).closest('.form-group .form-control').addClass('is-invalid');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group .form-control').removeClass('is-invalid').closest('.form-group .form-control').addClass('is-valid');
        },
        success: function (label) {
            label.closest('.form-group .form-control').removeClass('is-invalid');
        }
    });

    $('.app-configuration-form').submit(function (e) {
        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var formData = new FormData(form[0]);
        if (form.valid()) {
            $.ajax({
                url: url,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    if (response.success) {
                        toastr.success(response.message);
                        // form[0].reset();
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
        <h3 class="page-title">App Details</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('apps.index')}}">Manage Apps</a></li>
            <li class="breadcrumb-item active">{{ $app->app_name }}</li>
        </ol>
        <div class="page-actions">
            <a href="javascript:void(0);" onclick="publishApp('{{ $app->app_code }}');" class="btn btn-theme">Publish</a>
        </div>
    </div>
    <div class="row">
        @if(Auth::user()->hasAnyRole(['SuperAdmin', 'Support']) || (!in_array('SuperAdmin', Auth::user()->roles->pluck('name')->toArray()) && $app->permissions->count() > 0))
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h6>Details</h6>
                </div>
                <div class="card-body bg-light">
                    <div class="tabs tabs-default">
                        <ul class="nav nav-tabs" id="appTabContent">
                            @if(auth()->user()->hasAnyPermission(['Send Push Notification', 'Update Push Notification Settings']) || $app->hasAnyPermission(['Send Push Notification', 'Update Push Notification Settings']))
                            <li class="nav-item">
                                <a class="nav-link" id="notificationTab" data-toggle="tab"
                                    href="#notification">Notification</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View In-App Announcement', 'Create In-App Announcement', 'Edit In-App Announcement', 'Delete In-App Announcement']) || $app->hasAnyPermission(['View In-App Announcement', 'Create In-App Announcement', 'Edit In-App Announcement', 'Delete In-App Announcement']))
                            <li class="nav-item">
                                <a class="nav-link" id="inAppAnnouncementTab" data-toggle="tab"
                                    href="#inAppAnnouncement">Announcement</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View DNS', 'Create DNS', 'Edit DNS', 'Delete DNS']) || $app->hasAnyPermission(['View DNS', 'Create DNS', 'Edit DNS', 'Delete DNS']))
                            <li class="nav-item">
                                <a class="nav-link" id="dnsTab" data-toggle="tab" href="#dns">DNS</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Private Menu', 'Create Private Menu', 'Edit Private Menu', 'Delete Private Menu']) || $app->hasAnyPermission(['View Private Menu', 'Create Private Menu', 'Edit Private Menu', 'Delete Private Menu']))
                            <li class="nav-item">
                                <a class="nav-link" id="menuTab" data-toggle="tab" href="#privateMenu">Menu</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update App Wide Logo', 'Update TV Banner Image', 'Update Mobile Icon Image', 'Update Background Image', 'Update Splash Screen Image', 'Update Remote Image']) || $app->hasAnyPermission(['View App Images', 'Update App Wide Logo', 'Update TV Banner Image', 'Update Mobile Icon Image', 'Update Background Image', 'Update Splash Screen Image', 'Update Remote Image']))
                            <li class="nav-item">
                                <a class="nav-link" id="imageTab" data-toggle="tab" href="#image">Image</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Version', 'Update App Version']) || $app->hasAnyPermission(['View App Version', 'Update App Version']))
                            <li class="nav-item">
                                <a class="nav-link" id="versionTab" data-toggle="tab" href="#version">Version</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Player', 'Update App Player']) || $app->hasAnyPermission(['View App Player', 'Update App Player']))
                            <li class="nav-item">
                                <a class="nav-link" id="playerTab" data-toggle="tab" href="#player">Player</a>
                            </li>
                            @endif

                            @if(auth()->user()->can('View App Users') || $app->hasAnyPermission(['View App Users']))
                            <li class="nav-item">
                                <a class="nav-link" id="usersListTab" data-toggle="tab" href="#usersList">Users</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View About Us', 'Update About Us']) || $app->hasAnyPermission(['View About Us', 'Update About Us']))
                            <li class="nav-item">
                                <a class="nav-link" id="aboutUsTab" data-toggle="tab" href="#aboutUs">About Us</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Support', 'Update Support']) || $app->hasAnyPermission(['View Support', 'Update Support']))
                            <li class="nav-item">
                                <a class="nav-link" id="supportTab" data-toggle="tab" href="#support">Support</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View VPN Config', 'Update VPN Config']) || $app->hasAnyPermission(['View VPN Config', 'Update VPN Config']))
                            <li class="nav-item">
                                <a class="nav-link" id="vpnTab" data-toggle="tab" href="#vpn">VPN</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Endpoint', 'Update App Endpoint']) || $app->hasAnyPermission(['View App Endpoint', 'Update App Endpoint']))
                            <li class="nav-item">
                                <a class="nav-link" id="endpointTab" data-toggle="tab" href="#endpoint">Endpoint</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View API Key', 'Update API Key']) || $app->hasAnyPermission(['View API Key', 'Update API Key']))
                            <li class="nav-item">
                                <a class="nav-link" id="apiKeyTab" data-toggle="tab" href="#apiKey">API Key</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Theme', 'Update Theme', 'View Background', 'Update Background']) || $app->hasAnyPermission(['View Theme', 'Update Theme', 'View Background', 'Update Background']))
                            <li class="nav-item">
                                <a class="nav-link" id="appearanceTab" data-toggle="tab"
                                    href="#appearance">Appearance</a>
                            </li>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Ads Config', 'Update Ads Config']) || $app->hasAnyPermission(['View Ads Config', 'Update Ads Config']))
                            <li class="nav-item">
                                <a class="nav-link" id="adsTab" data-toggle="tab" href="#ads">Ads</a>
                            </li>
                            @endif

                            @if(auth()->user()->can('Manage App Setting') || $app->hasAnyPermission(['Manage App Setting']))
                            <li class="nav-item">
                                <a class="nav-link" id="settingsTab" data-toggle="tab" href="#settings">Settings</a>
                            </li>
                            @endif
                        </ul>
                        <div class="tab-content" id="appTabContent">
                            @if(auth()->user()->hasAnyPermission(['Send Push Notification', 'Update Push Notification Settings']) || $app->hasAnyPermission(['Send Push Notification', 'Update Push Notification Settings']))
                            <div class="tab-pane fade" id="notification">
                                <div class="row">
                                    @if(auth()->user()->can('Send Push Notification') || $app->hasAnyPermission(['Send Push Notification']))
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Send Notification</h5>
                                                <hr class="mt-0">
                                                <form method="POST" action="" id="notificationForm" novalidate
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="notiTitle">Title *</label>
                                                            <input type="text" id="notiTitle" name="title"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="message">Message *</label>
                                                            <textarea name="message" id="message" rows="5"
                                                                class="form-control" required></textarea>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <p class="mb-2">Image <small>(Optional)</small></p>
                                                            <div class="custom-file">
                                                                <input type="file" name="image"
                                                                    class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="externalLink">External Link
                                                                <small>(Optional)</small></label>
                                                            <input type="text" id="externalLink" name="external_link"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <button type="button" class="btn btn-primary">Send</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->can('Update Push Notification Settings') || $app->hasAnyPermission(['Update Push Notification Settings']))
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Notification Settings</h5>
                                                <hr class="mt-0">
                                                <form id="notificationSettings" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type"
                                                        value="notificationSettings">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="oneSignalAppId">One Signal App ID *</label>
                                                            <input type="text" id="oneSignalAppId"
                                                                name="one_signal_app_id" class="form-control"
                                                                value="@isset($app->settings){{ $app->settings->one_signal_app_id }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="oneSignalRestKey">One Signal Rest Key *</label>
                                                            <input type="text" id="oneSignalRestKey"
                                                                name="one_signal_rest_key" class="form-control"
                                                                value="@isset($app->settings){{ $app->settings->one_signal_rest_key }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="oneSignalGoogleProjectNo">One Signal Google
                                                                Project No
                                                                *</label>
                                                            <input type="text" id="oneSignalGoogleProjectNo"
                                                                name="one_signal_google_project_no" class="form-control"
                                                                value="@isset($app->settings){{ $app->settings->one_signal_google_project_no }}@endisset"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View In-App Announcement', 'Create In-App Announcement', 'Edit In-App Announcement', 'Delete In-App Announcement']) || $app->hasAnyPermission(['View In-App Announcement', 'Create In-App Announcement', 'Edit In-App Announcement', 'Delete In-App Announcement']))
                            <div class="tab-pane fade" id="inAppAnnouncement">
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['Create In-App Announcement', 'Edit In-App Announcement']) || $app->hasAnyPermission(['Create In-App Announcement', 'Edit In-App Announcement']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Add Announcement</h5>
                                                <hr class="mt-0">
                                                <form method="POST" action="" id="announcementForm" novalidate
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    <input type="hidden" name="announcement_id" id="announceId">
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="announceTitle">Title *</label>
                                                            <input type="text" id="announceTitle" name="title"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="shortDesc">Short Description *</label>
                                                            <textarea name="short_description" id="shortDesc" rows="5"
                                                                class="form-control" required></textarea>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <p class="mb-2">Image <small>(Optional)</small></p>
                                                            <div class="custom-file">
                                                                <input type="file" name="image"
                                                                    class="custom-file-input" id="announcementFile">
                                                                <label class="custom-file-label announcement-file-label"
                                                                    for="announcementFile">Choose file</label>
                                                            </div>
                                                            <img src="" id="viewAnnouncementImg" width="50px"
                                                                class="mt-2 d-none">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-vertical-center">
                                                                    <label class="mb-0 mr-2">Status</label>
                                                                    <input type="checkbox" id="announcementStatus"
                                                                        name="status" class="ls-switch" checked />
                                                                </div>
                                                            </div>
                                                            <hr class="my-0">
                                                        </div>
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" id="btnSaveAnnouncement" class="btn btn-primary">Send</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View In-App Announcement', 'Delete In-App Announcement']) || $app->hasAnyPermission(['View In-App Announcement', 'Delete In-App Announcement']))
                                    <div
                                        class="col-12 @if(auth()->user()->hasAnyPermission(['Create In-App Announcement', 'Edit In-App Announcement']) || $app->hasAnyPermission(['Create In-App Announcement', 'Edit In-App Announcement'])) {{ 'col-md-8' }} @endif">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Announcements</h5>
                                                <hr class="mt-0">
                                                <div class="table-responsive no-padding">
                                                    <table id="announcementsDatatable" class="table datatable"
                                                        cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Title</th>
                                                                <th width="30%">Short Description</th>
                                                                <th>Image</th>
                                                                <th>Status</th>
                                                                <th>Sent Users</th>
                                                                <th>Received Users</th>
                                                                <th>Click Users</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View DNS', 'Create DNS', 'Edit DNS', 'Delete DNS']) || $app->hasAnyPermission(['View DNS', 'Create DNS', 'Edit DNS', 'Delete DNS']))
                            <div class="tab-pane fade" id="dns">
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['Create DNS', 'Edit DNS']) || $app->hasAnyPermission(['Create DNS', 'Edit DNS']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Add DNS URL</h5>
                                                <hr class="mt-0">
                                                <form method="POST" id="dnsUrlForm" novalidate
                                                    enctype="multipart/form-data">
                                                    {{csrf_field()}}
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    <input type="hidden" name="dns_id" id="dnsId">
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="dnsTitle">DNS Title *</label>
                                                            <input type="text" id="dnsTitle" name="dns_title"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="dnsUrl">Url *</label>
                                                            <input type="text" id="dnsUrl" name="url"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="liveDns">Live DNS</label>
                                                            <input type="text" id="liveDns" name="live_dns"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="epgDns">EPG DNS</label>
                                                            <input type="text" id="epgDns" name="epg_dns"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="movieDns">Movie DNS</label>
                                                            <input type="text" id="movieDns" name="movie_dns"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="seriesDns">Series DNS</label>
                                                            <input type="text" id="seriesDns" name="series_dns"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="catchupDns">Catchup DNS</label>
                                                            <input type="text" id="catchupDns" name="catchup_dns"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                                    <button id="btnSaveDns" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View DNS', 'Delete DNS']) || $app->hasAnyPermission(['View DNS', 'Delete DNS']))
                                    <div
                                        class="col-12 @if(auth()->user()->hasAnyPermission(['Create DNS', 'Edit DNS']) || $app->hasAnyPermission(['Create DNS', 'Edit DNS'])) {{ 'col-md-8' }} @endif">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">DNS URL List</h5>
                                                <hr class="mt-0">
                                                <div class="table-responsive no-padding">
                                                    <table id="dnsDatatable" class="table datatable" cellspacing="0"
                                                        width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>DNS Title</th>
                                                                <th>DNS URL</th>
                                                                <th>Live DNS</th>
                                                                <th>EPG DNS</th>
                                                                <th>Movie DNS</th>
                                                                <th>Series DNS</th>
                                                                <th>Catchup DNS</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Private Menu', 'Create Private Menu', 'Edit Private Menu', 'Delete Private Menu']) || $app->hasAnyPermission(['View Private Menu', 'Create Private Menu', 'Edit Private Menu', 'Delete Private Menu']))
                            <div class="tab-pane fade" id="privateMenu">
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['Create Private Menu', 'Edit Private Menu']) || $app->hasAnyPermission(['Create Private Menu', 'Edit Private Menu']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Add Menu</h5>
                                                <hr class="mt-0">
                                                <form method="POST" id="menuForm" novalidate
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    <input type="hidden" name="menu_id" id="menuId">
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="addtionAppName">App Name *</label>
                                                            <input type="text" id="addtionAppName"
                                                                name="addtion_app_name" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="addtionAppPackageName">App Package Name
                                                                *</label>
                                                            <input type="text" id="addtionAppPackageName"
                                                                name="addtion_app_pkg" class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="addtionAppUrl">App URL *</label>
                                                            <input type="text" id="addtionAppUrl" name="addtion_app_url"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <p class="mb-2">App Icon</p>
                                                            <div class="custom-file">
                                                                <input type="file" name="addtion_app_icon"
                                                                    class="custom-file-input" id="additionAppIcon"
                                                                    data-target="viewAppMenuIcon">
                                                                <label class="custom-file-label menu-file-label"
                                                                    for="additionAppIcon">Choose file</label>
                                                            </div>
                                                            <div class="pt-2">
                                                                <img src="" id="viewAppMenuIcon" width="50px" alt="">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="d-flex-between">
                                                                <label class="mb-0 mr-2"
                                                                    for="additionAppStatus">Status</label>
                                                                <input type="checkbox" name="addtion_app_status"
                                                                    class="ls-switch" id="additionAppStatus" />
                                                            </div>
                                                        </div>
                                                        <hr class=" mt-0">
                                                    </div>
                                                    <button id="btnSaveMenu" class="btn btn-primary">Save</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Private Menu', 'Delete Private Menu']) || $app->hasAnyPermission(['View Private Menu', 'Delete Private Menu']))
                                    <div
                                        class="col-12 @if(auth()->user()->hasAnyPermission(['Create Private Menu', 'Edit Private Menu']) || $app->hasAnyPermission(['Create Private Menu', 'Edit Private Menu'])) {{ 'col-md-8' }} @endif">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Menu List</h5>
                                                <hr class="mt-0">
                                                <div class="table-responsive no-padding">
                                                    <table id="menuDatatable" class="table datatable" cellspacing="0"
                                                        width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>App Name</th>
                                                                <th>App Logo</th>
                                                                <th>App Package Name</th>
                                                                <th>App URL</th>
                                                                <th>Status</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update App Wide Logo', 'Update TV Banner Image', 'Update Mobile Icon Image', 'Update Background Image', 'Update Splash Screen Image', 'Update Remote Image']) || $app->hasAnyPermission(['View App Images', 'Update App Wide Logo', 'Update TV Banner Image', 'Update Mobile Icon Image', 'Update Background Image', 'Update Splash Screen Image', 'Update Remote Image']))
                            <div class="tab-pane fade" id="image">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Image</h5>
                                        <hr class="mt-0">
                                        <div class="row">
                                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update App Wide Logo']) || $app->hasAnyPermission(['View App Images', 'Update App Wide Logo']))
                                            <div class="col-12 col-md-4">
                                                <div class="card">
                                                    @if(isset($app->image) && !empty($app->image->app_wide_logo))
                                                    <img class="card-img-top"
                                                        src="{{ url('/uploads/app_images/', $app->image->app_wide_logo) }}"
                                                        id="imgWideLogo">
                                                    @else
                                                    <img class="card-img-top"
                                                        src="{{ asset('assets/admin/img/741x147.png') }}"
                                                        id="imgWideLogo">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">App Wide Logo</h5>
                                                        <p class="card-text">741 x 147 White + Transparent</p>
                                                        @if(auth()->user()->can('Update App Wide Logo') || $app->hasAnyPermission(['Update App Wide Logo']))
                                                        <form class="app-configuration-form app-image-form"
                                                            action="{{route("appimage.store")}}" enctype="multipart/form-data">
                                                            <input type="hidden" name="image_type"
                                                                value="app_wide_logo">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            <div class="custom-file">
                                                                <input type="file" name="app_image"
                                                                    class="custom-file-input" data-target="imgWideLogo"
                                                                    id="inputWideLogo">
                                                                <label class="custom-file-label" for="wideLogo">Choose
                                                                    Logo</label>
                                                            </div>
                                                            <div class="text-center mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update TV Banner Image']) || $app->hasAnyPermission(['View App Images', 'Update TV Banner Image']))
                                            <div class="col-12 col-md-4">
                                                <div class="card">
                                                    @if(isset($app->image) && !empty($app->image->tv_banner_image))
                                                    <img class="card-img-top"
                                                        src="{{ url('/uploads/app_images/', $app->image->tv_banner_image) }}"
                                                        id="imgTvBanner">
                                                    @else
                                                    <img class="card-img-top"
                                                        src="{{ asset('assets/admin/img/640x360.png') }}"
                                                        id="imgTvBanner">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">TV Banner Image</h5>
                                                        <p class="card-text">640 x 360</p>
                                                        @if(auth()->user()->can('Update TV Banner Image') || $app->hasAnyPermission(['Update TV Banner Image']))
                                                        <form class="app-configuration-form app-image-form"
                                                            action="{{route("appimage.store")}}" enctype="multipart/form-data">
                                                            <input type="hidden" name="image_type"
                                                                value="tv_banner_image">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            <div class="custom-file">
                                                                <input type="file" name="app_image"
                                                                    class="custom-file-input" data-target="imgTvBanner"
                                                                    id="inputTvBanner">
                                                                <label class="custom-file-label"
                                                                    for="inputTvBanner">Choose
                                                                    Logo</label>
                                                            </div>
                                                            <div class="text-center mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update Mobile Icon Image']) || $app->hasAnyPermission(['View App Images', 'Update Mobile Icon Image']))
                                            <div class="col-12 col-md-4">
                                                <div class="card">
                                                    @if(isset($app->image) &&
                                                    !empty($app->image->app_mobile_icon_image))
                                                    <img class="card-img-top"
                                                        src="{{ url('/uploads/app_images/', $app->image->app_mobile_icon_image) }}"
                                                        id="appMobileIconImage">
                                                    @else
                                                    <img class="card-img-top"
                                                        src="{{ asset('assets/admin/img/512x512.png') }}"
                                                        id="appMobileIconImage">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">App Mobile Icon Image</h5>
                                                        <p class="card-text">512 x 512</p>
                                                        @if(auth()->user()->can('Update Mobile Icon Image') || $app->hasAnyPermission(['Update Mobile Icon Image']))
                                                        <form class="app-configuration-form app-image-form"
                                                            action="{{route("appimage.store")}}" enctype="multipart/form-data">
                                                            <input type="hidden" name="image_type"
                                                                value="app_mobile_icon_image">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            <div class="custom-file">
                                                                <input type="file" name="app_image"
                                                                    class="custom-file-input"
                                                                    data-target="appMobileIconImage"
                                                                    id="inputMobileIconImage">
                                                                <label class="custom-file-label"
                                                                    for="inputMobileIconImage">Choose
                                                                    Logo</label>
                                                            </div>
                                                            <div class="text-center mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update Background Image']) || $app->hasAnyPermission(['View App Images', 'Update Background Image']))
                                            <div class="col-12 col-md-4">
                                                <div class="card">
                                                    @if(isset($app->image) && !empty($app->image->app_background))
                                                    <img class="card-img-top"
                                                        src="{{ url('/uploads/app_images/', $app->image->app_background) }}"
                                                        id="appBackground">
                                                    @else
                                                    <img class="card-img-top"
                                                        src="{{ asset('assets/admin/img/1280x720.png') }}"
                                                        id="appBackground">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">App Background</h5>
                                                        <p class="card-text">1280 x 720</p>
                                                        @if(auth()->user()->can('Update Background Image') || $app->hasAnyPermission(['Update Background Image']))
                                                        <form class="app-configuration-form app-image-form"
                                                            action="{{route("appimage.store")}}" enctype="multipart/form-data">
                                                            <input type="hidden" name="image_type"
                                                                value="app_background">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            <div class="custom-file">
                                                                <input type="file" name="app_image"
                                                                    class="custom-file-input"
                                                                    data-target="appBackground" id="inputAppBackground">
                                                                <label class="custom-file-label"
                                                                    for="inputAppBackground">Choose
                                                                    Logo</label>
                                                            </div>
                                                            <div class="text-center mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update Splash Screen Image']) || $app->hasAnyPermission(['View App Images', 'Update Splash Screen Image']))
                                            <div class="col-12 col-md-4">
                                                <div class="card">
                                                    @if(isset($app->image) && !empty($app->image->app_splash_screen))
                                                    <img class="card-img-top"
                                                        src="{{ url('/uploads/app_images/', $app->image->app_splash_screen) }}"
                                                        id="appSplashScreen">
                                                    @else
                                                    <img class="card-img-top"
                                                        src="{{ asset('assets/admin/img/1280x720.png') }}"
                                                        id="appSplashScreen">
                                                    @endif
                                                    <div class="card-body">
                                                        <h5 class="card-title">App Splash Screen</h5>
                                                        <p class="card-text">1280 x 720</p>
                                                        @if(auth()->user()->can('Update Splash Screen Image') || $app->hasAnyPermission(['Update Splash Screen Image']))
                                                        <form class="app-configuration-form app-image-form"
                                                            action="{{route("appimage.store")}}" enctype="multipart/form-data">
                                                            <input type="hidden" name="image_type"
                                                                value="app_splash_screen">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            <div class="custom-file">
                                                                <input type="file" name="app_image"
                                                                    class="custom-file-input"
                                                                    data-target="appSplashScreen"
                                                                    id="inputAppSplashScreen">
                                                                <label class="custom-file-label"
                                                                    for="inputAppSplashScreen">Choose
                                                                    Logo</label>
                                                            </div>
                                                            <div class="text-center mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View App Images', 'Update Remote Image']) || $app->hasAnyPermission(['View App Images', 'Update Remote Image']))
                                            <div class="col-12 col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">App Remote Image</h5>
                                                        <form class="app-configuration-form"
                                                            action="{{route("appimage.store")}}">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            <input type="hidden" name="image_type" value="remote_image">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Remote Image</label>
                                                                    <input type="checkbox" name="app_remote_image"
                                                                        class="ls-switch"
                                                                        @if($app->image->app_remote_image == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            @if(auth()->user()->can('Update Remote Image') || $app->hasAnyPermission(['Update Remote Image']))
                                                            <div class="text-center mt-4">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Upload</button>
                                                            </div>
                                                            @endif
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Version', 'Update App Version']) || $app->hasAnyPermission(['View App Version', 'Update App Version']))
                            <div class="tab-pane fade" id="version">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">App Version</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update App Version') || $app->hasAnyPermission(['Update App Version']))
                                                <form id="formAppVersion" class="app-configuration-form"
                                                    action="{{route("appversion.store")}}">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="vName">Version Name *</label>
                                                        <input type="text" id="vName" name="version_name"
                                                            class="form-control"
                                                            value="@isset($app->version){{ $app->version->version_name }}@endisset"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vCode">Version Code *</label>
                                                        <input type="text" id="vCode" name="version_code"
                                                            class="form-control"
                                                            value="@isset($app->version){{ $app->version->version_code }}@endisset"
                                                            required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="playstoreUrl">Play Store URL *</label>
                                                        <input type="text" id="playstoreUrl" name="play_store_url"
                                                            value="@isset($app->version){{ $app->version->play_store_url }}@endisset"
                                                            class="form-control" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="apkUrl">APK URL *</label>
                                                        <input type="text" id="apkUrl" name="apk_url"
                                                            class="form-control" required
                                                            value="@isset($app->version){{ $app->version->apk_url }}@endisset">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="updateMessage">Version Update Message *</label>
                                                        <input type="text" id="updateMessage"
                                                            name="version_update_message" class="form-control"
                                                            value="@isset($app->version){{ $app->version->version_update_message }}@endisset"
                                                            required>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-vertical-center">
                                                            <label class="mb-0 mr-2">Version Check</label>
                                                            <input type="checkbox" name="version_check"
                                                                class="ls-switch" @if($app->version->version_check
                                                            == 1)
                                                            {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-vertical-center">
                                                            <label class="mb-0 mr-2">Force Update</label>
                                                            <input type="checkbox" name="force_update" class="ls-switch"
                                                                @if($app->version->force_update ==
                                                            1)
                                                            {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    @if(auth()->user()->can('Update App Version') || $app->hasAnyPermission(['Update App Version']))
                                                    <button class="btn btn-primary mt-3">Save</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Player', 'Update App Player']) || $app->hasAnyPermission(['View App Player', 'Update App Player']))
                            <div class="tab-pane fade" id="player">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Default Player Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update App Player') || $app->hasAnyPermission(['Update App Player']))
                                                <form id="formAppPlayer" class="app-configuration-form"
                                                    action="{{route("player.store")}}">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <p class="mb-2">Live TV</p>
                                                        <div class="custom-control custom-radio d-inline-block">
                                                            <input type="radio" id="liveTvExo" value="Exo Player"
                                                                name="live_tv" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->live_tv == "Exo Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="liveTvExo" class="custom-control-label">Exo
                                                                Player</label>
                                                        </div>
                                                        <div class="custom-control custom-radio d-inline-block ml-4">
                                                            <input type="radio" id="liveTvVlc" value="VLC Player"
                                                                name="live_tv" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->live_tv == "VLC Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="liveTvVlc" class="custom-control-label">VLC
                                                                Player</label>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <p class="mb-2">VOD</p>
                                                        <div class="custom-control custom-radio d-inline-block">
                                                            <input type="radio" id="vodExo" value="Exo Player"
                                                                name="vod" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->vod == "Exo Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="vodExo" class="custom-control-label">Exo
                                                                Player</label>
                                                        </div>
                                                        <div class="custom-control custom-radio d-inline-block ml-4">
                                                            <input type="radio" id="vodVlc" value="VLC Player"
                                                                name="vod" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->vod == "VLC Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="vodVlc" class="custom-control-label">VLC
                                                                Player</label>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <p class="mb-2">Series</p>
                                                        <div class="custom-control custom-radio d-inline-block">
                                                            <input type="radio" id="seriesExo" value="Exo Player"
                                                                name="series" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->series == "Exo Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="seriesExo" class="custom-control-label">Exo
                                                                Player</label>
                                                        </div>
                                                        <div class="custom-control custom-radio d-inline-block ml-4">
                                                            <input type="radio" id="seriesVlc" value="VLC Player"
                                                                name="series" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->series == "VLC Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="seriesVlc" class="custom-control-label">VLC
                                                                Player</label>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <p class="mb-2">Catchup</p>
                                                        <div class="custom-control custom-radio d-inline-block">
                                                            <input type="radio" id="catchupExo" value="Exo Player"
                                                                name="catchup" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->catch_up == "Exo Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="catchupExo" class="custom-control-label">Exo
                                                                Player</label>
                                                        </div>
                                                        <div class="custom-control custom-radio d-inline-block ml-4">
                                                            <input type="radio" id="catchupVlc" value="VLC Player"
                                                                name="catchup" class="custom-control-input"
                                                                @if(isset($app->player) &&
                                                            $app->player->catch_up == "VLC Player") {{ 'checked' }}
                                                            @endif>
                                                            <label for="catchupVlc" class="custom-control-label">VLC
                                                                Player</label>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    @if(auth()->user()->can('Update App Player') || $app->hasAnyPermission(['Update App Player']))
                                                    <button class="btn btn-primary mt-3">Save</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->can('View App Users') || $app->hasAnyPermission(['View App Users']))
                            <div class="tab-pane fade" id="usersList">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Users List</h5>
                                        <hr class="mt-0">
                                        <div class="table-responsive no-padding">
                                            <table id="appUsersTable" class="table datatable" cellspacing="0"
                                                width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Full Name</th>
                                                        <th width="30%">Email Address</th>
                                                        <th>Username</th>
                                                        <th>Status</th>
                                                        <th>Created On</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View About Us', 'Update About Us']) || $app->hasAnyPermission(['View About Us', 'Update About Us']))
                            <div class="tab-pane fade" id="aboutUs">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">About Us</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update About Us') || $app->hasAnyPermission(['Update About Us']))
                                                <form id="aboutUsForm" class="app-configuration-form"
                                                    action="{{route("aboutUs.store")}}">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="appName">App Name *</label>
                                                            <input type="text" id="appName" name="app_name"
                                                                class="form-control"
                                                                value="@isset($app->app_name){{ $app->app_name }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="description">Description *</label>
                                                            <input type="text" id="description" name="description"
                                                                class="form-control"
                                                                value="@isset($app->aboutus){{ $app->aboutus->description }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="developedBy">Developed By *</label>
                                                            <input type="text" id="developedBy" name="developed_by"
                                                                class="form-control"
                                                                value="@isset($app->aboutus){{ $app->aboutus->developed_by }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="skypeId">Skype ID *</label>
                                                            <input type="text" id="skypeId" name="about_skype_id"
                                                                class="form-control"
                                                                value="@isset($app->aboutus){{ $app->aboutus->about_skype_id }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="telegramNo">Telegram No *</label>
                                                            <input type="text" id="telegramNo" name="about_telegram_no"
                                                                class="form-control"
                                                                value="@isset($app->aboutus){{ $app->aboutus->about_telegram_no }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="whatsappNo">Whatsapp No *</label>
                                                            <input type="text" id="whatsappNo" name="about_whatsapp_no"
                                                                class="form-control"
                                                                value="@isset($app->aboutus){{ $app->aboutus->about_whatsapp_no }}@endisset"
                                                                required>
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->can('Update About Us') || $app->hasAnyPermission(['Update About Us']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Support', 'Update Support']) || $app->hasAnyPermission(['View Support', 'Update Support']))
                            <div class="tab-pane fade" id="support">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Support Team</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Support') || $app->hasAnyPermission(['Update Support']))
                                                <form id="supportTeam" class="app-configuration-form"
                                                    action="{{route("supportTeam.store")}}">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="supportEmail">Email ID *</label>
                                                            <input type="text" id="supportEmail" name="support_email"
                                                                class="form-control"
                                                                value="@isset($app->support){{ $app->support->support_email }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="supportWebsite">Website *</label>
                                                            <input type="text" id="supportWebsite"
                                                                name="support_website" class="form-control"
                                                                value="@isset($app->support){{ $app->support->support_website }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="supportSkypeId">Skype ID *</label>
                                                            <input type="text" id="supportSkypeId"
                                                                name="support_skype_id" class="form-control"
                                                                value="@isset($app->support){{ $app->support->support_skype_id }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="supportTelegramNo">Telegram No *</label>
                                                            <input type="text" id="supportTelegramNo"
                                                                name="support_telegram_no" class="form-control"
                                                                value="@isset($app->support){{ $app->support->support_telegram_no }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="supportWhatsappNo">Whatsapp No *</label>
                                                            <input type="text" id="supportWhatsappNo"
                                                                name="support_whatsapp_no" class="form-control"
                                                                value="@isset($app->support){{ $app->support->support_whatsapp_no }}@endisset"
                                                                required>
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->can('Update Support') || $app->hasAnyPermission(['Update Support']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View VPN Config', 'Update VPN Config']) || $app->hasAnyPermission(['View VPN Config', 'Update VPN Config']))
                            <div class="tab-pane fade" id="vpn">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">VPN</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update VPN Config') || $app->hasAnyPermission(['Update VPN Config']))
                                                <form id="vpnForm" class="app-configuration-form"
                                                    action="{{route("vpn.store")}}">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <p class="mb-2">Mode</p>
                                                        <div class="custom-control custom-radio d-inline-block">
                                                            <input type="radio" id="system" value="system"
                                                                name="vpn_mode" class="custom-control-input"
                                                                @if($app->vpn->vpn_mode == 'system') {{ 'checked' }}
                                                            @endif>
                                                            <label for="system"
                                                                class="custom-control-label">System</label>
                                                        </div>
                                                        <div class="custom-control custom-radio d-inline-block ml-4">
                                                            <input type="radio" id="custom" value="custom"
                                                                name="vpn_mode" class="custom-control-input"
                                                                @if($app->vpn->vpn_mode == 'custom') {{ 'checked' }}
                                                            @endif>
                                                            <label for="custom"
                                                                class="custom-control-label">Custom</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vpnUsername">VPN Username</label>
                                                        <input type="text" id="vpnUsername" name="vpn_username"
                                                            class="form-control" value="{{ $app->vpn->vpn_username }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="vpnPassword">VPN Password</label>
                                                        <input type="text" id="vpnPassword" name="vpn_password"
                                                            class="form-control" value="{{ $app->vpn->vpn_password }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update VPN Config') || $app->hasAnyPermission(['Update VPN Config']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View App Endpoint', 'Update App Endpoint']) || $app->hasAnyPermission(['View App Endpoint', 'Update App Endpoint']))
                            <div class="tab-pane fade" id="endpoint">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Endpoint</h5>
                                        <hr class="mt-0">
                                        @if(auth()->user()->can('Update App Endpoint') || $app->hasAnyPermission(['Update App Endpoint']))
                                        <form id="endpointForm" class="app-configuration-form"
                                            action="{{route("endpoint.store")}}">
                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                            @endif
                                            <div class="form-row">
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="m3uParse">M3U Parse</label>
                                                    <input type="text" id="m3uParse" name="m3u_parse"
                                                        class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->m3u_parse }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="login">Login</label>
                                                    <input type="text" id="login" name="login" class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->login }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="register">Register</label>
                                                    <input type="text" id="register" name="register"
                                                        class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->register }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="listGet">List Get</label>
                                                    <input type="text" id="listGet" name="list_get" class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->list_get }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="listXstreamUpdate">List Xstream Update</label>
                                                    <input type="text" id="listXstreamUpdate" name="list_xstream_update"
                                                        class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->list_xstream_update }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="deleteurl">Delete URL</label>
                                                    <input type="text" id="deleteurl" name="deleteurl"
                                                        class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->deleteurl }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="list_m3u_update">List M3U Update</label>
                                                    <input type="text" id="list_m3u_update" name="list_m3u_update"
                                                        class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->list_m3u_update }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="epgEndpoint">EPG Endpoint</label>
                                                    <input type="text" id="epgEndpoint" name="epg_endpoint"
                                                        class="form-control"
                                                        value="@isset($app->endpoint){{ $app->endpoint->epg_endpoint }}@endisset">
                                                </div>
                                            </div>
                                            @if(auth()->user()->can('Update App Endpoint') || $app->hasAnyPermission(['Update App Endpoint']))
                                            <button class="btn btn-primary">Update</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View API Key', 'Update API Key']) || $app->hasAnyPermission(['View API Key', 'Update API Key']))
                            <div class="tab-pane fade" id="apiKey">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">API Key</h5>
                                        <hr class="mt-0">
                                        @if(auth()->user()->can('Update API Key') || $app->hasAnyPermission(['Update API Key']))
                                        <form id="apiKeyForm" class="app-configuration-form"
                                            action="{{route("apiKey.store")}}">
                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                            @endif
                                            <div class="form-row">
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="imdbApi">IMDB API</label>
                                                    <input type="text" id="imdbApi" name="imdb_api" class="form-control"
                                                        value="@isset($app->apiKey){{ $app->apiKey->imdb_api }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="imageImdb">Image IMDB</label>
                                                    <input type="text" id="imageImdb" name="image_imdb"
                                                        class="form-control"
                                                        value="@isset($app->apiKey){{ $app->apiKey->image_imdb }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="gApiKey">G API Key</label>
                                                    <input type="text" id="gApiKey" name="g_api_key"
                                                        class="form-control"
                                                        value="@isset($app->apiKey){{ $app->apiKey->g_api_key }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="weatherApi">Weather API</label>
                                                    <input type="text" id="weatherApi" name="weather_api"
                                                        class="form-control"
                                                        value="@isset($app->apiKey){{ $app->apiKey->weather_api }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="traktApiKey">Trakt API Key</label>
                                                    <input type="text" id="traktApiKey" name="trakt_api_key"
                                                        class="form-control"
                                                        value="@isset($app->apiKey){{ $app->apiKey->trakt_api_key }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="ipStackKey">IP Stack Key</label>
                                                    <input type="text" id="ipStackKey" name="ip_stack_key"
                                                        class="form-control"
                                                        value="@isset($app->apiKey){{ $app->apiKey->ip_stack_key }}@endisset">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="checkIp">Check IP</label>
                                                    <input type="text" id="checkIp" name="check_ip" class="form-control"
                                                        value="@isset($app->apiKey){{ $app->apiKey->check_ip }}@endisset">
                                                </div>
                                            </div>
                                            @if(auth()->user()->can('Update API Key') || $app->hasAnyPermission(['Update API Key']))
                                            <button class="btn btn-primary">Update</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Theme', 'Update Theme', 'View Background', 'Update Background']) || $app->hasAnyPermission(['View Theme', 'Update Theme', 'View Background', 'Update Background']))
                            <div class="tab-pane fade" id="appearance">
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['View Theme', 'Update Theme']) || $app->hasAnyPermission(['View Theme', 'Update Theme']))
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Theme</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Theme') || $app->hasAnyPermission(['Update Theme']))
                                                <form id="themeForm" class="app-configuration-form"
                                                    action="{{route("theme.store")}}">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for="defaultLayout">Theme Default Layout</label>
                                                            <select name="theme_defult_layout" id="defaultLayout"
                                                                class="form-control">
                                                                <option value="">Select Layout</option>
                                                                @for ($i = 1; $i < 6; $i++) <option value="L{{ $i }}"
                                                                    @if($app->theme->theme_defult_layout == ("L".$i))
                                                                    {{ 'selected' }} @endif
                                                                    >Layout {{ $i }}</option>
                                                                    @endfor
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Theme Color 1</label>
                                                            <input type="text" name="theme_color_1"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->theme->theme_color_1)){{ $app->theme->theme_color_1 }}@endif">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Theme Color 2</label>
                                                            <input type="text" name="theme_color_2"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->theme->theme_color_2)){{ $app->theme->theme_color_2 }}@endif">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Theme Color 3</label>
                                                            <input type="text" name="theme_color_3"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->theme->theme_color_3)){{ $app->theme->theme_color_3 }}@endif">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Roku Color Primary</label>
                                                            <input type="text" name="roku_color_primary"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->theme->roku_color_primary)){{ $app->theme->roku_color_primary }}@endif">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Roku Color Secondary</label>
                                                            <input type="text" name="roku_color_secondary"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->theme->roku_color_secondary)){{ $app->theme->roku_color_secondary }}@endif">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Roku Button Focus</label>
                                                            <input type="text" name="roku_button_focus"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->theme->roku_button_focus)){{ $app->theme->roku_button_focus }}@endif">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Roku Button Unfocus</label>
                                                            <input type="text" name="roku_button_unfocus"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->theme->roku_button_unfocus)){{ $app->theme->roku_button_unfocus }}@endif">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label>Roku Background Overlay</label>
                                                            <input type="text" name="roku_background_overlay"
                                                                class="form-control"
                                                                value="@if(isset($app->theme->roku_background_overlay)){{ $app->theme->roku_background_overlay }}@endif">
                                                        </div>
                                                        <div class="col-12">
                                                            <hr class="mt-0">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <div class="d-flex-between">
                                                                <label class="mb-0">Theme Change</label>
                                                                <input type="checkbox" name="theme_change"
                                                                    class="ls-switch" @if($app->theme->theme_change
                                                                == 1)
                                                                {{'checked'}} @endif />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    @if(auth()->user()->can('Update Theme') || $app->hasAnyPermission(['Update Theme']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Background', 'Update Background']) || $app->hasAnyPermission(['View Background', 'Update Background']))
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Background</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Background') || $app->hasAnyPermission(['Update Background']))
                                                <form id="backgroundForm" class="app-configuration-form"
                                                    action="{{route("background.store")}}"
                                                    enctype="multipart/form-data">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label>Background Overlay Color Code</label>
                                                            <input type="text" name="background_orverlay_color_code"
                                                                class="form-control colorpicker"
                                                                value="@if(isset($app->background->background_orverlay_color_code)){{ $app->background->background_orverlay_color_code }}@endif">
                                                            <hr class="mb-0">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <div class="d-flex-between">
                                                                <label class="mb-0">Auto Change</label>
                                                                <input type="checkbox" name="background_auto_change"
                                                                    class="ls-switch"
                                                                    @if($app->background->background_auto_change == 1)
                                                                {{'checked'}} @endif />
                                                            </div>
                                                            <hr class="mb-0">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <div class="d-flex-between">
                                                                <label class="mb-0">Manual Change</label>
                                                                <input type="checkbox" name="background_mannual_change"
                                                                    class="ls-switch"
                                                                    @if($app->background->background_mannual_change ==
                                                                1)
                                                                {{'checked'}} @endif />
                                                            </div>
                                                            <hr class="mb-0">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <div class="d-flex-between">
                                                                <label class="mb-0">Remote Change</label>
                                                                <input type="checkbox" name="back_remote_change"
                                                                    class="ls-switch"
                                                                    @if($app->background->back_remote_change == 1)
                                                                {{'checked'}} @endif />
                                                            </div>
                                                            <hr class="mb-0">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <div class="d-flex-between">
                                                                <label class="mb-0">Overlay Remote Change</label>
                                                                <input type="checkbox"
                                                                    name="back_orverlay_remote_change" class="ls-switch"
                                                                    @if($app->background->back_orverlay_remote_change ==
                                                                1)
                                                                {{'checked'}} @endif />
                                                            </div>
                                                            <hr class="mb-0">
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label class="control-label">Background Images <br>
                                                                <small>Drag & Drop files here or click to browse</small>
                                                            </label>
                                                            <div class="input-background-images"></div>
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->can('Update Background') || $app->hasAnyPermission(['Update Background']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->hasAnyPermission(['View Ads Config', 'Update Ads Config']) || $app->hasAnyPermission(['View Ads Config', 'Update Ads Config']))
                            <div class="tab-pane fade" id="ads">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Ads Config</h5>
                                        <hr class="mt-0">
                                        @if(auth()->user()->can('Update Ads Config') || $app->hasAnyPermission(['Update Ads Config']))
                                        <form id="appAds" class="app-configuration-form"
                                            action="{{route("app.settings")}}">
                                            <input type="hidden" name="setting_type" value="appAds">
                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                            @endif
                                            <div class="form-row">
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="adsAppId" class="control-label">Ads App ID</label>
                                                    <input type="text" name="ads_app_id" id="adsAppId"
                                                        class="form-control" value="{{ $app->ads->ads_app_id }}">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="adsBanner" class="control-label">Ads Banner</label>
                                                    <input type="text" name="ads_banner" id="adsBanner"
                                                        class="form-control" value="{{ $app->ads->ads_banner }}">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="adsIntrestial" class="control-label">Ads
                                                        Intrestial</label>
                                                    <input type="text" name="ads_intrestial" id="adsIntrestial"
                                                        class="form-control" value="{{ $app->ads->ads_intrestial }}">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="adsRewarded" class="control-label">Ads
                                                        Rewarded</label>
                                                    <input type="text" name="ads_rewarded" id="adsRewarded"
                                                        class="form-control" value="{{ $app->ads->ads_rewarded }}">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="adsNative" class="control-label">Ads Native</label>
                                                    <input type="text" name="ads_native" id="adsNative"
                                                        class="form-control" value="{{ $app->ads->ads_native }}">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <label for="adsIntrestialTimeDelay" class="control-label">Ads
                                                        Intrestial Time Delay</label>
                                                    <input type="text" name="ads_intrestial_time_delay"
                                                        id="adsIntrestialTimeDelay" class="form-control"
                                                        value="{{ $app->ads->ads_intrestial_time_delay }}">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <hr class="mt-0">
                                                    <div class="d-flex-between">
                                                        <label class="mb-0">Ads iOS Status</label>
                                                        <input type="checkbox" name="ads_ios_status" class="ls-switch"
                                                            @if($app->ads->ads_ios_status == 1) {{'checked'}} @endif/>
                                                    </div>
                                                    <hr class="mb-0">
                                                </div>
                                                <div class="form-group col-12 col-md-6">
                                                    <hr class="mt-0">
                                                    <div class="d-flex-between">
                                                        <label class="mb-0">Ads Status</label>
                                                        <input type="checkbox" name="ads_status" class="ls-switch"
                                                            @if($app->ads->ads_status == 1) {{'checked'}}
                                                        @endif/>
                                                    </div>
                                                    <hr class="mb-0">
                                                </div>
                                            </div>
                                            @if(auth()->user()->can('Update Ads Config') || $app->hasAnyPermission(['Update Ads Config']))
                                            <button class="btn btn-primary">Update</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(auth()->user()->can('Manage App Setting') || $app->hasAnyPermission(['Manage App Setting']))
                            <div class="tab-pane fade" id="settings">
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['View App Configuration', 'Update App Configuration']) || $app->hasAnyPermission(['View App Configuration', 'Update App Configuration']))
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">App Configuration</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update App Configuration') || $app->hasAnyPermission(['Update App Configuration']))
                                                <form id="appConfiguration" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="appConfiguration">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-row">
                                                        <div class="form-group col-12">
                                                            <label for="packageName">Package Name</label>
                                                            <input type="text" id="packageName" name="package_name"
                                                                class="form-control"
                                                                value="@isset($app->package_name){{ $app->package_name }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12">
                                                            <label for="startupMsg">Startup Message</label>
                                                            <input type="text" id="startupMsg" name="startup_message"
                                                                class="form-control"
                                                                value="@isset($app->settings){{ $app->settings->startup_message }}@endisset"
                                                                required>
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->can('Update App Configuration') || $app->hasAnyPermission(['Update App Configuration']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Language', 'Update Language']) || $app->hasAnyPermission(['View Language', 'Update Language']))
                                    <div class="col-12 col-md-6">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">App Language</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Language') || $app->hasAnyPermission(['Update Language']))
                                                <form id="appLanguage" class="app-configuration-form"
                                                    action="{{route("applanguage.store")}}">
                                                    <input type="hidden" name="setting_type" value="appLanguage">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="defaultLanguage">Default Language</label>
                                                        <input type="text" id="defaultLanguage" name="defult_language"
                                                            class="form-control"
                                                            value="@isset($app->language->defult_language){{$app->language->defult_language}}@endisset"
                                                            required>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Firstime select language</label>
                                                            <input type="checkbox" name="firstime_select_language"
                                                                class="ls-switch"
                                                                @if($app->language->firstime_select_language == 1)
                                                            {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    @if(auth()->user()->can('Update Language') || $app->hasAnyPermission(['Update Language']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View URL', 'Update URL']) || $app->hasAnyPermission(['View URL', 'Update URL']))
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">URLs</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update URL') || $app->hasAnyPermission(['Update URL']))
                                                <form id="appUrls" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="appUrls">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-row">
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for="domainUrl" class="control-label">Domain
                                                                URL</label>
                                                            <input type="text" name="domain_url" id="domainUrl"
                                                                class="form-control"
                                                                value="{{ $app->settings->domain_url }}">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for="policyUrl">Privacy Policy URL</label>
                                                            <input type="text" id="policyUrl" name="privacy_policy_url"
                                                                class="form-control"
                                                                value="@isset($app->settings){{ $app->settings->privacy_policy_url }}@endisset"
                                                                required>
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for="loginUrl" class="control-label">Login
                                                                URL</label>
                                                            <input type="text" name="login_url" id="loginUrl"
                                                                class="form-control"
                                                                value="{{ $app->settings->login_url }}">
                                                        </div>
                                                        <div class="form-group col-12 col-md-6">
                                                            <label for="chatUrl" class="control-label">Chat URL</label>
                                                            <input type="text" name="chat_url" id="chatUrl"
                                                                class="form-control"
                                                                value="{{ $app->settings->chat_url }}">
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->can('Update URL') || $app->hasAnyPermission(['Update URL']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @if(auth()->user()->hasAnyPermission(['View General Setting', 'Update General Setting']) || $app->hasAnyPermission(['View General Setting', 'Update General Setting']))
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">General Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update General Setting') || $app->hasAnyPermission(['Update General Setting']))
                                                <form id="generalSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="generalSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Boot On Startup</label>
                                                                    <input type="checkbox" name="startup_auto_boot"
                                                                        class="ls-switch"
                                                                        @if($app->settings->startup_auto_boot == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Private Menu</label>
                                                                    <input type="checkbox" name="private_menu"
                                                                        class="ls-switch"
                                                                        @if($app->settings->private_menu == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">VPN Sub Splash</label>
                                                                    <input type="checkbox" name="vpn_sub_splash"
                                                                        class="ls-switch" @if($app->settings->vpn_sub_splash
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Allow Cast</label>
                                                                    <input type="checkbox" name="allow_cast"
                                                                        class="ls-switch" @if($app->settings->allow_cast
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Clear Catch</label>
                                                                    <input type="checkbox" name="clear_catch"
                                                                        class="ls-switch"
                                                                        @if($app->settings->clear_catch == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">App External Plugin</label>
                                                                    <input type="checkbox" name="app_external_plugin"
                                                                        class="ls-switch"
                                                                        @if($app->settings->app_external_plugin == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Intro Video</label>
                                                                    <input type="checkbox" name="intro_video"
                                                                        class="ls-switch"
                                                                        @if($app->settings->intro_video == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Server Selection</label>
                                                                    <input type="checkbox" name="server_selection"
                                                                        class="ls-switch"
                                                                        @if($app->settings->server_selection == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">System Setting</label>
                                                                    <input type="checkbox" name="setting_option"
                                                                        class="ls-switch"
                                                                        @if($app->settings->setting_option == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Wifi Option</label>
                                                                    <input type="checkbox" name="wifi_option"
                                                                        class="ls-switch"
                                                                        @if($app->settings->wifi_option == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">VPN Login Screen</label>
                                                                    <input type="checkbox" name="vpn_login_screen"
                                                                        class="ls-switch" @if($app->settings->vpn_login_screen
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Remote Support</label>
                                                                    <input type="checkbox" name="remote_support"
                                                                        class="ls-switch"
                                                                        @if($app->settings->remote_support == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Sub Profile</label>
                                                                    <input type="checkbox" name="sub_profile"
                                                                        class="ls-switch"
                                                                        @if($app->settings->sub_profile == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Startup Plugin Install</label>
                                                                    <input type="checkbox" name="startup_plugin_install"
                                                                        class="ls-switch"
                                                                        @if($app->settings->startup_plugin_install == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Auto Login</label>
                                                                    <input type="checkbox" name="auto_login"
                                                                        class="ls-switch" @if($app->settings->auto_login
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Catchup</label>
                                                                    <input type="checkbox" name="is_catchup"
                                                                        class="ls-switch" @if($app->settings->is_catchup
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                        </div>
                                                        <div class="col-12 col-md-6 col-lg-4">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">App List Settings</label>
                                                                    <input type="checkbox" name="app_list_status"
                                                                        class="ls-switch"
                                                                        @if($app->settings->app_list_status == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">VPN</label>
                                                                    <input type="checkbox" name="is_vpn"
                                                                        class="ls-switch" @if($app->settings->is_vpn ==
                                                                    1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Sub Splash</label>
                                                                    <input type="checkbox" name="sub_splash"
                                                                        class="ls-switch" @if($app->settings->sub_splash
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Remind Me</label>
                                                                    <input type="checkbox" name="remind_me"
                                                                        class="ls-switch" @if($app->settings->remind_me
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Startup Archive Category</label>
                                                                    <input type="checkbox"
                                                                        name="startup_archive_category"
                                                                        class="ls-switch"
                                                                        @if($app->settings->startup_archive_category
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Multi Profile</label>
                                                                    <input type="checkbox" name="multi_profile"
                                                                        class="ls-switch"
                                                                        @if($app->settings->multi_profile == 1)
                                                                    {{'checked'}} @endif/>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Multi Profile Auto Login</label>
                                                                    <input type="checkbox"
                                                                        name="multi_profile_auto_login"
                                                                        class="ls-switch"
                                                                        @if($app->settings->multi_profile_auto_login ==
                                                                    1)
                                                                    {{'checked'}} @endif/>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                        </div>
                                                    </div>
                                                    @if(auth()->user()->can('Update General Setting') || $app->hasAnyPermission(['Update General Setting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['View App Settings', 'Update App Settings']) || $app->hasAnyPermission(['View App Settings', 'Update App Settings']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">App Settings</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update App Settings') || $app->hasAnyPermission(['Update App Settings']))
                                                <form id="appSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="appSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">App Settings</label>
                                                            <input type="checkbox" name="app_settings" class="ls-switch"
                                                                @if($app->settings->app_settings ==
                                                            1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">App General Settings</label>
                                                            <input type="checkbox" name="app_general_settings" class="ls-switch"
                                                                @if($app->settings->app_general_settings ==
                                                            1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="appSettingPasscode" class="control-label">App
                                                            Settings Passcode</label>
                                                        <input type="text" name="app_settings_passcode"
                                                            id="appSettingPasscode" class="form-control"
                                                            value="{{ $app->settings->app_settings_passcode }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update App Settings') || $app->hasAnyPermission(['Update App Settings']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if(auth()->user()->hasAnyPermission(['View Theme Settings', 'Update Theme Settings']) || $app->hasAnyPermission(['View Theme Settings', 'Update Theme Settings']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Theme Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Theme Settings') || $app->hasAnyPermission(['Update Theme Settings']))
                                                <form id="themeSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="themeSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Allow Theme Change</label>
                                                            <input type="checkbox" name="theme_change_allow"
                                                                class="ls-switch" @if($app->settings->theme_change_allow
                                                            == 1) {{'checked'}} @endif/>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="themeChangeLayout" class="control-label">Theme
                                                            Change Layout</label>
                                                        <input type="text" name="theme_change_layout"
                                                            id="themeChangeLayout" class="form-control"
                                                            value="{{ $app->settings->theme_change_layout }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Theme Settings') || $app->hasAnyPermission(['Update Theme Settings']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    @if(auth()->user()->hasAnyPermission(['View Sub User Profile', 'Update Sub User Profile']) || $app->hasAnyPermission(['View Sub User Profile', 'Update Sub User Profile']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Sub User Profile</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Sub User Profile') || $app->hasAnyPermission(['Update Sub User Profile']))
                                                <form id="subUserProfile" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="subUserProfile">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Sub User Profile</label>
                                                            <input type="checkbox" name="sub_user_profile"
                                                                class="ls-switch" @if($app->settings->sub_user_profile
                                                            == 1) {{'checked'}} @endif/>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Sub User Profile Default</label>
                                                            <input type="checkbox" name="sub_user_profile_default"
                                                                class="ls-switch" @if($app->settings->sub_user_profile_default
                                                            == 1) {{'checked'}} @endif/>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Sub User Profile Setting</label>
                                                            <input type="checkbox" name="sub_user_profile_setting"
                                                                class="ls-switch" @if($app->settings->sub_user_profile_setting
                                                            == 1) {{'checked'}} @endif/>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Sub User Profile Select on Start</label>
                                                            <input type="checkbox" name="sub_user_profile_select_on_start"
                                                                class="ls-switch" @if($app->settings->sub_user_profile_select_on_start
                                                            == 1) {{'checked'}} @endif/>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="subUserProfileAllow" class="control-label">Sub User
                                                            Profile Allow</label>
                                                        <input type="text" name="sub_user_profile_allow"
                                                            id="subUserProfileAllow" class="form-control"
                                                            value="{{ $app->settings->sub_user_profile_allow }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Sub User Profile') || $app->hasAnyPermission(['Update Sub User Profile']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['View Device Type', 'Update Device Type']) || $app->hasAnyPermission(['View Device Type', 'Update Device Type']))
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Device Type</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Device Type') || $app->hasAnyPermission(['Update Device Type']))
                                                <form id="deviceType" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="deviceType">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Startup Device Select</label>
                                                            <input type="checkbox" name="startup_device_select"
                                                                class="ls-switch"
                                                                @if($app->settings->startup_device_select == 1)
                                                            {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Manual Device Select</label>
                                                            <input type="checkbox" name="manual_device_select"
                                                                class="ls-switch"
                                                                @if($app->settings->manual_device_select == 1)
                                                            {{'checked'}}
                                                            @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    @if(auth()->user()->can('Update Device Type') || $app->hasAnyPermission(['Update Device Type']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Ticker Setting', 'Update Ticker Setting']) || $app->hasAnyPermission(['View Ticker Setting', 'Update Ticker Setting']))
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Ticker Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Ticker Setting') || $app->hasAnyPermission(['Update Ticker Setting']))
                                                <form id="tickerSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="tickerSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Dashboard Ticker</label>
                                                            <input type="checkbox" name="dashbord_ticker"
                                                                class="ls-switch" @if($app->settings->dashbord_ticker ==
                                                            1)
                                                            {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Login Ticker</label>
                                                            <input type="checkbox" name="login_ticker" class="ls-switch"
                                                                @if($app->settings->login_ticker == 1)
                                                            {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    @if(auth()->user()->can('Update Ticker Setting') || $app->hasAnyPermission(['Update Ticker Setting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Play Setting', 'Update Play Setting']) || $app->hasAnyPermission(['View Play Setting', 'Update Play Setting']))
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Play Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Play Setting') || $app->hasAnyPermission(['Update Play Setting']))
                                                <form id="playSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="playSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Set Default Play</label>
                                                            <input type="checkbox" name="set_default_play"
                                                                class="ls-switch" @if($app->settings->set_default_play
                                                            == 1)
                                                            {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Set Recent Play</label>
                                                            <input type="checkbox" name="set_recent_play"
                                                                class="ls-switch" @if($app->settings->set_recent_play ==
                                                            1)
                                                            {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    @if(auth()->user()->can('Update Play Setting') || $app->hasAnyPermission(['Update Play Setting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['View Default Device', 'Update Default Device']) || $app->hasAnyPermission(['View Default Device', 'Update Default Device']))
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Default Device</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Default Device') || $app->hasAnyPermission(['Update Default Device']))
                                                <form id="defaultDevice" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="defaultDevice">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Detect</label>
                                                            <input type="checkbox" name="detect_default_device"
                                                                class="ls-switch"
                                                                @if($app->settings->detect_default_device == 1)
                                                            {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label class="control-label">Default
                                                            Device</label>
                                                        <input type="text" name="default_device" class="form-control"
                                                            value="{{ $app->settings->default_device }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Default Device') || $app->hasAnyPermission(['Update Default Device']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View 4k Setting', 'Update 4k Setting']) || $app->hasAnyPermission(['View 4k Setting', 'Update 4k Setting']))
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">4k Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update 4k Setting') || $app->hasAnyPermission(['Update 4k Setting']))
                                                <form id="app4kSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="app4kSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Allow 4k</label>
                                                            <input type="checkbox" name="allow_4k" class="ls-switch"
                                                                @if($app->settings->allow_4k
                                                            == 1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="4kContent" class="control-label">4k
                                                            Content</label>
                                                        <input type="text" name="content_4k" id="4kContent"
                                                            class="form-control"
                                                            value="{{ $app->settings->content_4k }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update 4k Setting') || $app->hasAnyPermission(['Update 4k Setting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Private Setting', 'Update Private Setting']) || $app->hasAnyPermission(['View Private Setting', 'Update Private Setting']))
                                    <div class="col-12 col-md-6 col-lg-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Private Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Private Setting') || $app->hasAnyPermission(['Update Private Setting']))
                                                <form id="privateSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="privateSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Private Access</label>
                                                            <input type="checkbox" name="private_access"
                                                                class="ls-switch" @if($app->settings->private_access ==
                                                            1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="privateVideoUrl" class="control-label">Private Video
                                                            URL</label>
                                                        <input type="text" name="private_video_url" id="privateVideoUrl"
                                                            class="form-control"
                                                            value="{{ $app->settings->private_video_url }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Private Setting') || $app->hasAnyPermission(['Update Private Setting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    @if(auth()->user()->hasAnyPermission(['View In-App Purchase', 'Update In-App Purchase']) || $app->hasAnyPermission(['View In-App Purchase', 'Update In-App Purchase']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">In App Purchase</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update In-App Purchase') || $app->hasAnyPermission(['Update In-App Purchase']))
                                                <form id="inAppPurchaseSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type"
                                                        value="inAppPurchaseSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">In App Status</label>
                                                            <input type="checkbox" name="in_app_status"
                                                                class="ls-switch" @if($app->settings->in_app_status ==
                                                            1) {{'checked'}} @endif/>
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="inAppPurchaseId" class="control-label">In App
                                                            Purchase ID</label>
                                                        <input type="text" name="in_app_purchase_id"
                                                            id="inAppPurchaseId" class="form-control"
                                                            value="{{ $app->settings->in_app_purchase_id }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inAppPurchaseLicenseKey"
                                                            class="control-label">License Key</label>
                                                        <input type="text" name="in_app_purchase_license_key"
                                                            id="inAppPurchaseLicenseKey" class="form-control"
                                                            value="{{ $app->settings->in_app_purchase_license_key }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update In-App Purchase') || $app->hasAnyPermission(['Update In-App Purchase']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Channel Reporting', 'Update Channel Reporting']) || $app->hasAnyPermission(['View Channel Reporting', 'Update Channel Reporting']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Channel Reporting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Channel Reporting') || $app->hasAnyPermission(['Update Channel Reporting']))
                                                <form id="channelReporting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="channelReporting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Channel Reporting</label>
                                                            <input type="checkbox" name="channel_reporting"
                                                                class="ls-switch" @if($app->settings->channel_reporting
                                                            == 1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="channelReportingToEmail"
                                                            class="control-label">Channel Reporting To
                                                            Email</label>
                                                        <input type="text" name="channel_reporting_to_email"
                                                            id="channelReportingToEmail" class="form-control"
                                                            value="{{ $app->settings->channel_reporting_to_email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="channelReportEmailSubject"
                                                            class="control-label">Channel Report Email
                                                            Subject</label>
                                                        <input type="text" name="channel_report_email_subject"
                                                            id="channelReportEmailSubject" class="form-control"
                                                            value="{{ $app->settings->channel_report_email_subject }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Channel Reporting') || $app->hasAnyPermission(['Update Channel Reporting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if(auth()->user()->hasAnyPermission(['View Movie Show Request', 'Update Movie Show Request']) || $app->hasAnyPermission(['View Movie Show Request', 'Update Movie Show Request']))
                                    <div class="col-12 col-md-4">
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Movie Show Request</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Movie Show Request') || $app->hasAnyPermission(['Update Movie Show Request']))
                                                <form id="movieShowRequest" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="movieShowRequest">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Movie Show Request</label>
                                                            <input type="checkbox" name="movie_show_reqest"
                                                                class="ls-switch" @if($app->settings->movie_show_reqest
                                                            == 1) {{'checked'}} @endif />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="movieShowReqestToEmail" class="control-label">Movie
                                                            Show Reqest To
                                                            Email</label>
                                                        <input type="text" name="movie_show_reqest_to_email"
                                                            id="movieShowReqestToEmail" class="form-control"
                                                            value="{{ $app->settings->movie_show_reqest_to_email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="movieShowReqestEmailSubject"
                                                            class="control-label">Movie Show Reqest Email
                                                            Subject</label>
                                                        <input type="text" name="movie_shows_reqest_email_subject"
                                                            id="movieShowReqestEmailSubject" class="form-control"
                                                            value="{{ $app->settings->movie_shows_reqest_email_subject }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Movie Show Request') || $app->hasAnyPermission(['Update Movie Show Request']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-8">
                                        <div class="row">
                                            @if(auth()->user()->hasAnyPermission(['View MQTT Setting', 'Update MQTT Setting']) || $app->hasAnyPermission(['View MQTT Setting', 'Update MQTT Setting']))
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">MQTT Setting</h5>
                                                        <hr class="mt-0">
                                                        @if(auth()->user()->can('Update MQTT Setting') || $app->hasAnyPermission(['Update MQTT Setting']))
                                                        <form id="mqttSetting" class="app-configuration-form"
                                                            action="{{route("app.settings")}}">
                                                            <input type="hidden" name="setting_type" value="mqttSetting">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            @endif
                                                            <div class="form-group">
                                                                <label for="mqttServer" class="control-label">MQTT
                                                                    Server</label>
                                                                <input type="text" name="mqtt_server" id="mqttServer"
                                                                    class="form-control"
                                                                    value="{{ $app->settings->mqtt_server }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="mqttEndpoint" class="control-label">MQTT
                                                                    Endpoint</label>
                                                                <input type="text" name="mqtt_endpoint" id="mqttEndpoint"
                                                                    class="form-control"
                                                                    value="{{ $app->settings->mqtt_endpoint }}">
                                                            </div>
                                                            @if(auth()->user()->can('Update MQTT Setting') || $app->hasAnyPermission(['Update MQTT Setting']))
                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View Header Setting', 'Update Header Setting']) || $app->hasAnyPermission(['View Header Setting', 'Update Header Setting']))
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Header Setting</h5>
                                                        <hr class="mt-0">
                                                        @if(auth()->user()->can('Update Header Setting') || $app->hasAnyPermission(['Update Header Setting']))
                                                        <form id="headerSetting" class="app-configuration-form"
                                                            action="{{route("app.settings")}}">
                                                            <input type="hidden" name="setting_type" value="headerSetting">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            @endif
                                                            <div class="form-group">
                                                                <label for="headerKey" class="control-label">Header Key</label>
                                                                <input type="text" name="header_key" id="headerKey"
                                                                    class="form-control"
                                                                    value="{{ $app->settings->header_key }}">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="headerValue" class="control-label">Header
                                                                    Value</label>
                                                                <input type="text" name="header_value" id="headerValue"
                                                                    class="form-control"
                                                                    value="{{ $app->settings->header_value }}">
                                                            </div>
                                                            @if(auth()->user()->can('Update Header Setting') || $app->hasAnyPermission(['Update Header Setting']))
                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        @if(auth()->user()->hasAnyPermission(['View SMTP Setting', 'Update SMTP Setting']) || $app->hasAnyPermission(['View SMTP Setting', 'Update SMTP Setting']))
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">SMTP Setting</h5>
                                                        <hr class="mt-0">
                                                        @if(auth()->user()->can('Update SMTP Setting') || $app->hasAnyPermission(['Update SMTP Setting']))
                                                        <form id="emailConfiguration" class="app-configuration-form"
                                                            action="{{route("app.settings")}}">
                                                            <input type="hidden" name="setting_type"
                                                                value="emailConfiguration">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            @endif
                                                            <div class="form-row">
                                                                <div class="form-group col-md-6">
                                                                    <label for="smtpServer" class="control-label">SMTP
                                                                        Server</label>
                                                                    <input type="text" name="smtp_server"
                                                                        id="smtpServer" class="form-control"
                                                                        value="{{ $app->settings->smtp_server }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="smtpPort" class="control-label">SMTP
                                                                        Port</label>
                                                                    <input type="text" name="smtp_port" id="smtpPort"
                                                                        class="form-control"
                                                                        value="{{ $app->settings->smtp_port }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="smtpUsername" class="control-label">SMTP
                                                                        Username</label>
                                                                    <input type="text" name="smtp_username"
                                                                        id="smtpUsername" class="form-control"
                                                                        value="{{ $app->settings->smtp_username }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="smtpPassword" class="control-label">SMTP
                                                                        Password</label>
                                                                    <input type="text" name="smtp_password"
                                                                        id="smtpPassword" class="form-control"
                                                                        value="{{ $app->settings->smtp_password }}">
                                                                </div>
                                                                <div class="form-group col-md-6">
                                                                    <label for="smtpFromEmail"
                                                                        class="control-label">SMTP
                                                                        From Email</label>
                                                                    <input type="text" name="smtp_from_email"
                                                                        id="smtpFromEmail" class="form-control"
                                                                        value="{{ $app->settings->smtp_from_email }}">
                                                                </div>
                                                            </div>
                                                            @if(auth()->user()->can('Update SMTP Setting') || $app->hasAnyPermission(['Update SMTP Setting']))
                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            @if(auth()->user()->hasAnyPermission(['View EPG Setting', 'Update EPG Setting']) || $app->hasAnyPermission(['View EPG Setting', 'Update EPG Setting']))
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">EPG Setting</h5>
                                                        <hr class="mt-0">
                                                        @if(auth()->user()->can('Update EPG Setting') || $app->hasAnyPermission(['Update EPG Setting']))
                                                        <form id="epgSetting" class="app-configuration-form"
                                                            action="{{route("app.settings")}}">
                                                            <input type="hidden" name="setting_type" value="epgSetting">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            @endif
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">EPG Timeshift</label>
                                                                    <input type="checkbox" name="epg_timeshift"
                                                                        class="ls-switch"
                                                                        @if($app->settings->epg_timeshift ==
                                                                    1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">EPG Catchup</label>
                                                                    <input type="checkbox" name="epg_catchup"
                                                                        class="ls-switch"
                                                                        @if($app->settings->epg_catchup == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">EPG Roku</label>
                                                                    <input type="checkbox" name="epg_roku"
                                                                        class="ls-switch" @if($app->settings->epg_roku
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            @if(auth()->user()->can('Update EPG Setting') || $app->hasAnyPermission(['Update EPG Setting']))
                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View Recording Setting', 'Update Recording Setting']) || $app->hasAnyPermission(['View Recording Setting', 'Update Recording Setting']))
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Recording Setting</h5>
                                                        <hr class="mt-0">
                                                        @if(auth()->user()->can('Update Recording Setting') || $app->hasAnyPermission(['Update Recording Setting']))
                                                        <form id="appRecording" class="app-configuration-form"
                                                            action="{{route("app.settings")}}">
                                                            <input type="hidden" name="setting_type"
                                                                value="appRecording">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            @endif
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Recording</label>
                                                                    <input type="checkbox" name="recording"
                                                                        class="ls-switch" @if($app->settings->recording
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Multi Recording</label>
                                                                    <input type="checkbox" name="multi_recording"
                                                                        class="ls-switch"
                                                                        @if($app->settings->multi_recording ==
                                                                    1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">Cloud Recording</label>
                                                                    <input type="checkbox" name="cloud_recording"
                                                                        class="ls-switch"
                                                                        @if($app->settings->cloud_recording
                                                                    == 1)
                                                                    {{'checked'}} @endif />
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            @if(auth()->user()->can('Update Recording Setting') || $app->hasAnyPermission(['Update Recording Setting']))
                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <div class="row">
                                            @if(auth()->user()->hasAnyPermission(['View P2P Setting','Update P2P Setting']) || $app->hasAnyPermission(['View P2P Setting','Update P2P Setting']))
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">P2P Setting</h5>
                                                        <hr class="mt-0">
                                                        @if(auth()->user()->can('Update P2P Setting') || $app->hasAnyPermission(['Update P2P Setting']))
                                                        <form id="p2pSetting" class="app-configuration-form"
                                                            action="{{route("app.settings")}}">
                                                            <input type="hidden" name="setting_type" value="p2pSetting">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            @endif
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">P2P</label>
                                                                    <input type="checkbox" name="p2p" class="ls-switch"
                                                                        @if($app->settings->p2p == 1)
                                                                    {{'checked'}}
                                                                    @endif/>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <label for="p2pSignal" class="control-label">P2P
                                                                    Signal</label>
                                                                <input type="text" name="p2p_signal" id="p2pSignal"
                                                                    class="form-control"
                                                                    value="{{ $app->settings->p2p_signal }}">
                                                            </div>
                                                            <hr class="mt-0">
                                                            <div class="form-group">
                                                                <div class="d-flex-between">
                                                                    <label class="mb-0">P2P Setting Default</label>
                                                                    <input type="checkbox" name="p2p_setting_default"
                                                                        class="ls-switch"
                                                                        @if($app->settings->p2p_setting_default == 1)
                                                                    {{'checked'}} @endif/>
                                                                </div>
                                                            </div>
                                                            <hr class="mt-0">
                                                            @if(auth()->user()->can('Update P2P Setting') || $app->hasAnyPermission(['Update P2P Setting']))
                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if(auth()->user()->hasAnyPermission(['View Stream Setting', 'Update Stream Setting']) || $app->hasAnyPermission(['View Stream Setting', 'Update Stream Setting']))
                                            <div class="col-12 col-md-6">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Stream Setting</h5>
                                                        <hr class="mt-0">
                                                        @if(auth()->user()->can('Update Stream Setting') || $app->hasAnyPermission(['Update Stream Setting']))
                                                        <form id="streamSetting" class="app-configuration-form"
                                                            action="{{route("app.settings")}}">
                                                            <input type="hidden" name="setting_type"
                                                                value="streamSetting">
                                                            <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                            @endif
                                                            <div class="form-group">
                                                                <label for="streamFormat" class="control-label">Stream
                                                                    Format</label>
                                                                <input type="text" name="stream_format"
                                                                    id="streamFormat" class="form-control"
                                                                    value="{{ $app->settings->stream_format }}">
                                                            </div>
                                                            @if(auth()->user()->can('Update Stream Setting') || $app->hasAnyPermission(['Update Stream Setting']))
                                                            <button class="btn btn-primary">Update</button>
                                                        </form>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        @if(auth()->user()->hasAnyPermission(['View Weather Setting', 'Update Weather Setting']) || $app->hasAnyPermission(['View Weather Setting', 'Update Weather Setting']))
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Weather Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Weather Setting') || $app->hasAnyPermission(['Update Weather Setting']))
                                                <form id="weatherSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="weatherSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <label for="weatherDefaultCity" class="control-label">Weather
                                                            Default City</label>
                                                        <input type="text" id="weatherDefaultCity"
                                                            name="weather_defult_city" class="form-control"
                                                            value="{{ $app->settings->weather_defult_city }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="weatherCity" class="control-label">City
                                                            Name</label>
                                                        <input type="text" id="weatherCity" name="weather_city"
                                                            class="form-control"
                                                            value="{{ $app->settings->weather_city }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="weatherCityId" class="control-label">City
                                                            ID</label>
                                                        <input type="text" id="weatherCityId" name="weather_city_id"
                                                            class="form-control"
                                                            value="{{ $app->settings->weather_city_id }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Weather Setting') || $app->hasAnyPermission(['Update Weather Setting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        @if(auth()->user()->hasAnyPermission(['View Report Issue Email', 'Update Report Issue Email']) || $app->hasAnyPermission(['View Report Issue Email', 'Update Report Issue Email']))
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Report Issue</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Report Issue Email') || $app->hasAnyPermission(['Update Report Issue Email']))
                                                <form id="reportIssueEmail" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="reportIssueEmail">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Report Issue</label>
                                                            <input type="checkbox" name="report_issue"
                                                                class="ls-switch" @if($app->settings->report_issue ==
                                                            1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="reportingApi" class="control-label">Reporting API</label>
                                                        <input type="text" name="reporting_api"
                                                            id="reportingApi" class="form-control"
                                                            value="{{ $app->settings->reporting_api }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reportIssueFromEmail" class="control-label">Report
                                                            Issue From Email</label>
                                                        <input type="email" name="report_issue_from_email"
                                                            id="reportIssueFromEmail" class="form-control"
                                                            value="{{ $app->settings->report_issue_from_email }}">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="reportIssueToEmail" class="control-label">Report
                                                            Issue To Email</label>
                                                        <input type="email" name="report_issue_to_email"
                                                            id="reportIssueToEmail" class="form-control"
                                                            value="{{ $app->settings->report_issue_to_email }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Report Issue Email') || $app->hasAnyPermission(['Update Report Issue Email']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                        @if(auth()->user()->hasAnyPermission(['View Cloud Setting', 'Update Cloud Setting']) || $app->hasAnyPermission(['View Cloud Setting', 'Update Cloud Setting']))
                                        <div class="card">
                                            <div class="card-body">
                                                <h5 class="card-title">Cloud Setting</h5>
                                                <hr class="mt-0">
                                                @if(auth()->user()->can('Update Cloud Setting') || $app->hasAnyPermission(['Update Cloud Setting']))
                                                <form id="cloudSetting" class="app-configuration-form"
                                                    action="{{route("app.settings")}}">
                                                    <input type="hidden" name="setting_type" value="cloudSetting">
                                                    <input type="hidden" name="app_id" value="{{ $app->id }}">
                                                    @endif
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Cloud Remind Me</label>
                                                            <input type="checkbox" name="cloud_remind_me"
                                                                class="ls-switch" @if($app->settings->cloud_remind_me ==
                                                            1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="cloudRemindMeUrl" class="control-label">Cloud Remind
                                                            Me URL</label>
                                                        <input type="text" name="cloud_remind_me_url"
                                                            id="cloudRemindMeUrl" class="form-control"
                                                            value="{{ $app->settings->cloud_remind_me_url }}">
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <div class="d-flex-between">
                                                            <label class="mb-0">Cloud Recent Fav</label>
                                                            <input type="checkbox" name="cloud_recent_fav"
                                                                class="ls-switch" @if($app->settings->cloud_recent_fav
                                                            ==
                                                            1) {{'checked'}} @endif
                                                            />
                                                        </div>
                                                    </div>
                                                    <hr class="mt-0">
                                                    <div class="form-group">
                                                        <label for="cloudRecentFavUrl" class="control-label">Cloud
                                                            Recent Fav URL</label>
                                                        <input type="text" name="cloud_recent_fav_url"
                                                            id="cloudRecentFavUrl" class="form-control"
                                                            value="{{ $app->settings->cloud_recent_fav_url }}">
                                                    </div>
                                                    @if(auth()->user()->can('Update Cloud Setting') || $app->hasAnyPermission(['Update Cloud Setting']))
                                                    <button class="btn btn-primary">Update</button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="col-12">
            <div class="access-denied-main">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('assets/admin/img/access-denied.png') }}" alt="">
                        <h4 class="text-muted">You don't have permission for this.</h4>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@stop
