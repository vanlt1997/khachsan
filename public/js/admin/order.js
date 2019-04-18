var rooms = [], i, check;

check = document.getElementsByClassName('img-choosed');
for (i = 0 ; i < check.length; i++)
{
    rooms.push(check[i].getAttribute('data-content'));
}
document.getElementById('nameRoom').value = rooms;

function styleRoomChoose() {
    var imgModal, icon;
    imgModal = document.getElementsByClassName('img-modal');
    for (i=0; i<imgModal.length; i++) {
        imgModal[i].className = imgModal[i].className.replace(" img-choosed", "");
    }
    for (i=0; i<rooms.length; i++) {
        if (document.getElementById(rooms[i])) {
            document.getElementById(rooms[i]).className += " img-choosed";
        }
    }
}

function chooseRoom(name) {
    if (rooms.includes(name)) {
        var key = rooms.indexOf(name);
        if (key == -1) {
            rooms.push(name);
        } else {
            rooms.splice(key, 1);
        }
    } else {
        rooms.push(name);
    }
    this.styleRoomChoose();
    $('#nameRoom').val(rooms);
    $('#choosedRoom').text(rooms);
    if ($('#nameRoom').val() === null || $('#nameRoom').val() === '') {
        $('#btnCalculate').prop("disabled", true);
    } else {
        $('#btnCalculate').removeAttr("disabled");
    }
}

