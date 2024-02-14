var Dashboard = (function () {
  var handleDatePicker = function () {
    $.fn.datepicker.dates['de'] = {
      days: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
      daysShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
      daysMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
      months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
      monthsShort: ["Jan", "Feb", "Mär", "Apr", "Mai", "Jun", "Jul", "Aug", "Sep", "Okt", "Nov", "Dez"],
      today: "Heute",
      monthsTitle: "Monate",
      clear: "Löschen",
      weekStart: 1,
      format: "dd.mm.yyyy"
    };

    var date = new Date();
    var today = new Date(date.getFullYear(), date.getMonth(), date.getDate());
    $('#fromdate').datepicker({
      autoclose: true,
      language: 'de',
      endDate: date
    }).on('changeDate', function () {
      var fromdate = moment($(this).val(), 'DD.MM.YYYY');
      $('#todate').datepicker('setStartDate', fromdate.toDate());
      if (!$('#todate').val()) {
        $('#todate').datepicker('setDate', today);
      }
    });

    $('#todate').datepicker({
      autoclose: true,
      language: 'de',
      endDate: date
    }).on('changeDate', function () {
      var todate = moment($(this).val(), 'DD.MM.YYYY');
      $('#fromdate').datepicker('setEndDate', todate.toDate());
    });
  };

  return {
    init: function () {
      handleDatePicker();
    }
  };
})();

jQuery(document).ready(function () {

  Dashboard.init();

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
});
