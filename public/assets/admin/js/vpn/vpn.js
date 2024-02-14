var Vpns = (function () {
  var handleValidation = function () {
    var form = $('#vpnForm');
    form.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        country: {
          required: true,
        },
        city: {
          required: true,
        },
        file_url: {
          required: true,
          // required: '#vpnFile:blank',
          url: true
        },
        // vpn_file: {
        //   required: '#fileUrl:blank',
        //   extension: 'ovpn'
        // },
      },
      messages: {
        country: {
          required: 'Please Select Country',
        },
        city: {
          required: 'Please Enter City',
        },
        file_url: {
          required: 'Please Enter File Url',
          url: 'Please Enter Valid Url'
        },
        // vpn_file: {
        //   extension: 'Only .ovpn file allowed'
        // }
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
  Vpns.init();

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