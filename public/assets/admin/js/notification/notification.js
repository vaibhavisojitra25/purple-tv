var Notification = (function () {

  var handleValidation = function () {
    var form = $('#notificationForm');
    validateForm = form.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        title: {
          required: true,
        },
        message: {
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
        message: {
          required: 'Please Enter Message',
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
  };

  return {
    init: function () {
      handleValidation();
    }
  };
})();

jQuery(document).ready(function () {
  var validateForm;
  Notification.init();
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $(".custom-file-input").on("change", function () {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
});