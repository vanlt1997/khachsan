function changeSelect() {
    var status = $('#status').val();
    if (status == 1) {
        $('#div-status').attr('hidden','');
    } else {
        $('#div-status').removeAttr('hidden');
    }
}
changeSelect();
