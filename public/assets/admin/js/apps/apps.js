var Apps = (function () {
  var handleValidation = function () {
    var form = $('#appForm');
    form.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        app_name: {
          required: true,
        },
        package_name: {
          required: true,
        },
        app_type: {
          required: true,
        },
        app_mode: {
          required: true,
        },
        app_icon: {
          required: true,
          accept: "image/jpg,image/jpeg,image/png"
        }
      },
      messages: {
        app_name: {
          required: 'Please Enter App Name',
        },
        package_name: {
          required: 'Please Enter Package Name',
        },
        app_type: {
          required: 'Please Select App Type',
        },
        app_mode: {
          required: 'Please Select App Mode',
        },
        app_icon: {
          required: 'Please Select App Icon',
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

    var editForm = $('#appEditForm');
    editForm.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        app_name: {
          required: true,
        },
        package_name: {
          required: true,
        },
        app_type: {
          required: true,
        },
        app_mode: {
          required: true,
        }
      },
      messages: {
        app_name: {
          required: 'Please Enter app name',
        },
        package_name: {
          required: 'Please Enter Package Name',
        },
        app_type: {
          required: 'Please Select App Type',
        },
        app_mode: {
          required: 'Please Select App Mode',
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
  };

  return {
    init: function () {
      handleValidation();
    }
  };
})();

jQuery(document).ready(function () {
  Apps.init();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

    var file = $(this).get(0).files[0];
    if (file) {
      var reader = new FileReader();
      reader.onload = function () {
        $("#viewImg").attr("src", reader.result).removeClass('d-none');
      }
      reader.readAsDataURL(file);
    }
  });

  $('#appMode').on("change", function() {
    if($(this).val() == 'Universal') {
      $('#appModeUniversal').removeClass('d-none');
      $('#appModeUni').rules('add', 'required');
    } else {
      $('#appModeUniversal').addClass('d-none');
      $('#appModeUni').rules('remove', 'required');
    }
  });
});

function takeAccess(url, redirectTo, leaveUrl) {
  var tab;
  $.ajax({
    url: url,
    type: "GET",
    success: function (response) {
      tab = window.open(redirectTo);
      swal({
        closeOnClickOutside: false,
        title: "Access",
        text: "You have taken an access of other user, you want to leave?",
        icon: "warning",
        buttons: {
          cancel: false,
          confirm: true,
        }
      }).then((willDelete) => {
        if (willDelete) {
          tab.close();
          $.ajax({
            url: leaveUrl,
            type: "GET",
            dataType: 'json',
            success: function (response) {},
            error: function (err) {}
          });
        }
      });
    },
    error: function (err) {
      if (err.responseJSON.message) {
        toastr.error(err.responseJSON.message);
      } else {
        toastr.error('Something went wrong');
      }
    }
  });
}