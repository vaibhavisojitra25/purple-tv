var Roles = (function () {
  var handleValidation = function () {
    var form = $('#roleForm');
    form.validate({
      errorElement: 'span',
      errorClass: 'help-block help-block-error',
      focusInvalid: false,
      ignore: '',
      rules: {
        name: {
          required: true,
        }
      },
      messages: {
        name: {
          required: 'Please Enter Role Name',
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
  Roles.init();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('#roleForm').on('submit', function (e) {
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
            form[0].reset();
            setTimeout(() => {
              window.location.href = '/roles';
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
});
