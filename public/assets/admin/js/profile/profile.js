var Profile = (function () {

  var handleValidation = function () {
    var form = $('#profileForm');
    form.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        profile_picture: {
          accept: "image/jpg,image/jpeg,image/png"
        },
        title: {
          required: true,
        },
        full_name: {
          required: true,
        },
        phone_number: {
          required: true,
          digits: true
        },
        country: {
          required: true,
        }
      },
      messages: {
        profile_picture: {
          accept: 'Allows only jpg, jpeg and png file'
        },
        title: {
          required: 'Please Enter Title',
        },
        full_name: {
          required: 'Please Enter Full Name',
        },
        phone_number: {
          required: 'Please Enter Phone Number',
          digits: 'Please Enter Valid Phone Number'
        },
        country: {
          required: 'Please Select Country',
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
  Profile.init();
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
        $("#previewImg").attr("src", reader.result);
      }
      reader.readAsDataURL(file);
    }
  });
});