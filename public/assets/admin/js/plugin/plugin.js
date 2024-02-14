var Plugins = (function () {
  var handleValidation = function () {
    var form = $('#pluginForm');
    form.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        name: {
          required: true,
        },
        pkg_name: {
          required: true,
        },
        version: {
          required: true,
        },
        playstore_url: {
          required: true,
          url: true
        },
        apk_url: {
          required: true,
          url: true
        }
      },
      messages: {
        name: {
          required: 'Please Enter Name',
        },
        pkg_name: {
          required: 'Please Enter Package Name',
        },
        version: {
          required: 'Please Enter Version',
        },
        playstore_url: {
          required: 'Please Enter Playstore Url',
          url: 'Please Enter Valid Url'
        },
        apk_url: {
          required: 'Please Enter Apk Url',
          url: 'Please Enter Valid Url'
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
  Plugins.init();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});