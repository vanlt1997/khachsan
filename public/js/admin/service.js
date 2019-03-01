$(document).ready(function () {
    changeInput();
});

function changeInput() {
    var status = $('#status').val();
    if (status == 1) {
        $('.div-status').hide();
    } else {
        $('.div-status').show();
    }
}
