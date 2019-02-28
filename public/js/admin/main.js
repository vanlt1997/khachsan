var imagesSession = [], i, check;

check = document.getElementsByClassName('img-start');
for (i = 0 ; i < check.length; i++)
{
    imagesSession.push(check[i].getAttribute('data-content'));
}
document.getElementById('images').value = imagesSession;

function listModal() {
    var imgModal, icon;
    imgModal = document.getElementsByClassName('img-modal');
    for (i=0; i<imgModal.length; i++) {
        imgModal[i].className = imgModal[i].className.replace(" img-choosed", "");
    }
    for (i=0; i<imagesSession.length; i++) {
        document.getElementById(imagesSession[i]).className += " img-choosed";
    }
}

function chooseImages(url) {
    if (imagesSession.includes(url)) {
        var key = imagesSession.indexOf(url);
        if (key == -1) {
            imagesSession.push(url);
        } else {
            imagesSession.splice(key, 1);
        }
    } else {
        imagesSession.push(url);
    }
    this.listModal();
}

function rejectImage(url) {
    this.chooseImages(url);
    this.chooseDone();
}

function chooseDone() {
    var list = '', i;
    for (i=0; i<imagesSession.length; i++) {
        list += "<div class='col-md-4 img-show pull-left'>" +
                    "<div class='reject-img' onclick=\"rejectImage('"+imagesSession[i]+"')\">" +
                        "<span class='button-reject-img'>&times;</span>" +
                    "</div>" +
                    "<img src='http://"+window.location.host+"/images/admin/library-images/"+imagesSession[i]+"' " +
                    "alt='img' class='img-thumbnail' style='width: 120px; height: 120px;'>" +
                "</div>"
    }
    $('#images-session').html(list);
    $('#images').val(this.imagesSession);
}


