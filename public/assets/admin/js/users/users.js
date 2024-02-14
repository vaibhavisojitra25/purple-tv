var Users = (function () {
  var handleValidation = function () {
    var form = $('#userForm');
    form.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        full_name: {
          required: true,
        },
        email: {
          required: true,
          email: true
        },
        phone_number: {
          required: true,
          digits: true
        },
        username: {
          required: true,
        },
        password: {
          required: true,
          minlength: 8
        },
        confirm_password: {
          required: true,
          equalTo: '#password'
        },
        role: {
          required: true
        }
      },
      messages: {
        full_name: {
          required: 'Please Enter Full Name',
        },
        email: {
          required: 'Please Enter Email Address',
          email: 'Please Enter Valid Email Address'
        },
        phone_number: {
          required: 'Please Enter Phone Number',
          digits: 'Please Enter Valid Phone Number'
        },
        username: {
          required: 'Please Enter Username',
        },
        password: {
          required: 'Please Enter Password',
          minlength: 'Password must be 8 characters',
        },
        confirm_password: {
          required: 'Please Enter Confirm Password',
          equalTo: 'Password and confirm password must be same'
        },
        role: {
          required: 'Please Select Role'
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
  Users.init();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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