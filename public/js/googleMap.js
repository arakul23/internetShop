function initMap(newOption) {
    var element = document.getElementById("map");
    var token = $("input[name=_token]").val();

    if (newOption === undefined) {
        newOption = {
            zoom: 13,
            center: {lat: 46.469391, lng: 30.740883}
        };

        var myMap = new google.maps.Map(element, newOption);

    }

    else {
        console.log(newOption[0].lng);

        var myMap = new google.maps.Map(element, {
            zoom: 13,
            center: {lat: parseFloat(newOption[0].lat), lng: parseFloat(newOption[0].lng)}
        });
    }

    $.ajax({
        type: "POST",
        url: "postOfficeMap",
        data: {"_token": token},
        success: function (properties) {

            addMarker(properties);

        }
    });


    function addMarker(properties) {
        for (var i = 0; i < properties.length; i++) {

            var workingTime = properties[i].working_time;
            var address = properties[i].address;
            var html = "<div class='col-lg-5'><label>Время работы</label>" +
                "<div style='width: 100px'>" + workingTime.replace(/\d\s/g, "0\n") + "<label>Адрес отделения</label>" + address + "</div></div>";
            var infowindow = new google.maps.InfoWindow({});

            var lat = parseFloat(properties[i].lat);
            var lng = parseFloat(properties[i].lng);
            var marker = new google.maps.Marker({
                position: {lat: lat, lng: lng},
                map: myMap

            });


            bindInfoWindow(marker, myMap, infowindow, html);


        }


    }


    function bindInfoWindow(marker, map, infowindow, html) {
        marker.addListener('click', function () {
            infowindow.setContent(html);
            infowindow.open(map, this);
        });
    }


}

function setPostOfficeOnMap() {
    var id = document.getElementById("postOffice").value;
    var token = $("input[name=_token]").val();

    $.ajax({
        type: "POST",
        url: "postOfficeForMap",
        data: {"_token": token, "id": id},
        success: function (result) {
            initMap(result);
        }
    });

}

