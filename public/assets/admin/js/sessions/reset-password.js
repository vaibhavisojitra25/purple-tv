var ResetPasswordForm = (function () {
    var handleValidation = function () {
      var form = $('#resetpasswordForm');
  
      form.validate({
        errorElement: 'span',
        errorClass: 'help-block help-block-error',
        focusInvalid: false,
        ignore: '',
        rules: {
            password: {
            required: true,
            minlength: 8
          },
          password_confirmation: {
            required: true,
            minlength: 8,
            equalTo : "#password"
          }
        },
        messages: {
            password: {
            required: "Enter password",
            minlength: "Password must be 8 characters"
          },
          password_confirmation: {
            required: "Enter confirm password",
            minlength: "Password must be 8 characters"
          }
        },
  
        highlight: function (element) { // hightlight error inputs
          $(element)
            .closest('.form-group .form-control').addClass('is-invalid'); // set invalid class to the control group
        },
        unhighlight: function (element) { // revert the change done by hightlight
          $(element)
            .closest('.form-group .form-control').removeClass('is-invalid') // set invalid class to the control group
            .closest('.form-group .form-control').addClass('is-valid'); // set valid class to the control group
        },
        success: function (label) {
          label
            .closest('.form-group .form-control').removeClass('is-invalid'); // set success class to the control group
        }
      });
    };
  
    return {
      // main function to initiate the module
      init: function () {
        handleValidation();
      }
    };
  })();
  
  jQuery(document).ready(function () {
    ResetPasswordForm.init();
  });