var imagesSession = [];
function chooseImages(id) {
    // var image = '', i;
    // let url = "http://localhost:8000/images-session";
    // $.ajax({
    //     url: url,
    //     type: 'post',
    //     data: {id: id},
    //     success: function (results) {
    //         $("#images-session").html(results);
    //     }
    // });
    if (imagesSession.includes(id)) {
        var key = imagesSession.indexOf(id);
        if (key == -1) {
            imagesSession.push(id);
        } else {
            delete imagesSession[key];
        }
    } else {
        imagesSession.push(id);
    }

    $("#images-session").html(imagesSession);
}

