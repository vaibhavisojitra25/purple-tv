import moment from 'moment';

window.moment = moment;

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});