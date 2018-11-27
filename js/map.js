// variables
var zoom = 12;
var lat = 35.1522437;
var lon = 33.3751678;
var mymap = L.map('mapid').setView([lat, lon], zoom);
var phpfile = "";
var pruneCluster = new PruneClusterForLeaflet();

// set black marker
var blackIcon = L.icon({
    iconUrl: 'img/black.svg',

    iconSize: [23.5, 31.25], // size of the icon

});

// set map on click
mymap.on('click', onMapClick);
var modal = document.getElementById('featureModal');
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
};

function onMapClick(e) {
    var lat = e.latlng.lat;
    var lon = e.latlng.lng;
    // default - placeholders
    var data = {
        name: "John Doe",
        location: "Nicosia, CY",
        operator: "SunnyCY",
        description: "Description",
        power: "x kWp",
        production: "x kWp",
        cO2: "x tons per annum",
        reimbursement: "x euro",
        modules: "x moodules",
        azimuth: "x°",
        inclination: "x°",
        communication: "x communication",
        inverter: "x inverter",
        sensors: "x sensor"

    };

    editModal(lat, lon, 0, data);

}

function editModal(lat, lon, exists, data) {

    // Get the modal
    $("#feature-title").html("Add a new PV");

    var form = "";

    if (exists) form = '<div class="figure" style="background-image: url(' + data.photo + ');"></div><br /><label class="btn btn-secondary"><input type="file" id="photo" name="photo">Upload Photo:</label>';

    form += '<form id="pv_form" name="pv_form" method="post"><div class="form-group">' +
        '<label for="name">Name:</label><input type="text" class="form-control" id="name" name="name" placeholder="' + data.name + '">' +
        '</div><div class="form-group"><label for="location">Location:</label><input type="text" class="form-control" id="location" name="location" placeholder="' + data.location + '">' +
        '</div><div class="form-group"><label for="operator">Operator:</label><input type="text" class="form-control" id="operator" name="operator" placeholder="' + data.operator + '"></div>' +
        '<div class="form-group"><label for="commission">';

    if (exists) form += 'Current Commission: ' + data.commission;
    else form += 'Commission:';

    form += '</label><input type="date" class="form-control" id="commission" name="commission">' +
        '</div><div class="form-group"><label for="description">Description</label><textarea name="description" id="description" cols="30" rows="5" placeholder="' + data.description + '"></textarea>' +
        '</div><div class="form-group"><label for="power">System Power:</label><input type="text" class="form-control" id="power" name="power" placeholder="' + data.power + '">' +
        '</div><div class="form-group"><label for="production">Annual Production:</label><input type="text" class="form-control" id="production" name="production" placeholder="' + data.power + '">' +
        '</div><div class="form-group"><label for="co2">CO2 Avoided:</label><input type="text" class="form-control" id="co2" name="co2" placeholder="' + data.cO2 + '">' +
        '</div><div class="form-group"><label for="reimbursement">Reimbursement:</label><input type="text" class="form-control" id="reimbursement" name="reimbursement" placeholder="' + data.reimbursement + '">' +
        '</div><div class="form-group"><label for="modules">Solar Panel Modules:</label><input type="text" class="form-control" id="modules" name="modules" placeholder="' + data.modules + '">' +
        '</div><div class="form-group"><label for="azimuth">Azimuth Angle:</label><input type="text" class="form-control" id="azimuth" name="azimuth" placeholder="' + data.azimuth + '">' +
        '</div><div class="form-group"><label for="inclination">Inclination Angle:</label><input type="text" class="form-control" id="inclination" name="inclination" placeholder="' + data.inclination + '">' +
        '</div><div class="form-group"><label for="communication">Communication:</label><input type="text" class="form-control" id="communication" name="communication" placeholder="' + data.communication + '">' +
        '</div><div class="form-group"><label for="inverter">Inverter:</label><input type="text" class="form-control" id="inverter" name="inverter" placeholder="' + data.inverter + '">' +
        '</div><div class="form-group"><label for="sensors">Sensors:</label><input type="text" class="form-control" id="sensors" name="sensors" placeholder="' + data.sensors + '"></div>' +
        '<input type="hidden" name="lat" value="' + lat + '"/><input type="hidden" name="lon" value="' + lon + '"/>';

    $("#feature-info").html(form);
    $("#feature-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button><button id="myFormSubmit" type="submit" class="btn btn-primary">Save</button></form>');
    $("#featureModal").modal("show");

    $('#myFormSubmit').click(function (e) {
        e.preventDefault();

        if (exists) updatePV(data);
        else createPV();
    });

}

pruneCluster.PrepareLeafletMarker = function (leafletMarker, data) {
    leafletMarker.setIcon(blackIcon);

    leafletMarker.on('click', function () {

        var info = "<div class='figure' style='background-image: url('" + data.photo + "');'></div>" + "<br /><b>Location:</b> " + data.location + " " + data.coordinates + "<br /><b>Operator: </b> " +
            data.operator + "<br /><b>Commission: </b> " + data.commission + "<br /><b>Description: </b> " + data.description +
            +"<br /><b>System Power: </b> " + data.power + "<br /><b>Annual Production: </b> " + data.production +
            "<br /><b>CO2 Avoided: </b> " + data.cO2 + "<br /><b>Reimbursement: </b> " + data.reimbursement +
            "<br /><b>Solar Panel Modules: </b> " + data.modules + "<br /><b>Azimuth Angle: </b> " + data.azimuth +
            "<br /><b>Inclination Angle: </b> " + data.inclination + "<br /><b>Communication: </b> " + data.communication +
            "<br /><b>Inverter: </b> " + data.inverter + "<br /><b>Sensors: </b> " + data.sensors;

        $("#feature-title").html(data.name);
        $("#feature-info").html(info);
        $("#feature-footer").html('<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button><button id="editPV" type="button" class="btn btn-primary" data-dismiss="modal">Edit</button><button type="button" class="btn btn-danger" id="deletePV" data-dismiss="modal">Delete</button>');
        $("#featureModal").modal("show");

        $('#editPV').click(function (e) {
            e.preventDefault();

            editModal(lat, lon, 1, data);
        });

        $('#deletePV').click(function (e) {
            e.preventDefault();

            deletePV(data);
        });
    });
};

window.onload = mapLoad;

function mapLoad() {

// initialize map with tiles:
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 18,
        minZoom: 2,
        maxBounds: L.latLngBounds(L.latLng(-90, -180), L.latLng(90, 180)),
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(mymap);

    ajaxCall("GET", phpfile, "", "text", loadPVs);

    pruneCluster.ProcessView();

}

function loadPVs() {

    var pv = {
        id: 1,
        name: "UCY PV's",
        lon: 33.425217,
        lat: 35.199623,
        location: "Nicosia, CYPRUS",
        photo: L.icon({
            iconUrl: 'img/avatar6.png',

            iconSize: [23.5, 31.25], // size of the icon

        }),
        operator: "UCY",
        commission: "04/12/18",
        description: "lala sun",
        power: "9.800",
        production: "13.720",
        cO2: "9.6",
        reimbursement: "7",
        modules: "40 x Solar Innova SI_ESF_245M",
        azimuth: "-10",
        inclination: "15",
        communication: "Sunny WebBox mit Bluetooth",
        inverter: "3 x Sunny Boy 3300TL HC",
        sensors: "Sunny Sensorbox"
    };
    prunePoints(pv);


}

function createPV() {

    phpfile = 'create.php';
    var data = new FormData(document.getElementById("pv_form"));

    ajaxCallPOST("POST", phpfile, data);
}


function alertSuccessFailure(data) {

    if ((data == "Your PV is uploaded successfully.") || (data == "Your PV was deleted successfully") || (data == "Your PV was updated successfully")) {
        swal({
            type: 'success',
            title: data,
            showConfirmButton: false,
            timer: 1500
        });
        $("#featureModal").modal("hide");
    } else {
        swal({
            type: 'error',
            title: 'Oops...',
            text: data
        });
    }


}

function updatePV(data) {

    phpfile = "update.php";

    var updatedData = new FormData(document.getElementById("pv_form"));

    // check if some data weren't change.
    if (!updatedData.get('photo'))
        updatedData.set('photo', data.photo);
    if (!updatedData.get('name'))
        updatedData.set('location', data.name);
    if (!updatedData.get('location'))
        updatedData.set('location', data.location);
    if (!updatedData.get('operator'))
        updatedData.set('operator', data.operator);
    if (!updatedData.get('commission'))
        updatedData.set('commission', data.commission);
    if (!updatedData.get('description'))
        updatedData.set('description', data.description);
    if (!updatedData.get('power'))
        updatedData.set('power', data.power);
    if (!updatedData.get('production'))
        updatedData.set('production', data.production);
    if (!updatedData.get('co2'))
        updatedData.set('co2', data.cO2);
    if (!updatedData.get('reimbursement'))
        updatedData.set('reimbursement', data.reimbursement);
    if (!updatedData.get('modules'))
        updatedData.set('modules', data.modules);
    if (!updatedData.get('azimuth'))
        updatedData.set('azimuth', data.azimuth);
    if (!updatedData.get('inclination'))
        updatedData.set('inclination', data.inclination);
    if (!updatedData.get('communication'))
        updatedData.set('communication', data.communication);
    if (!updatedData.get('inverter'))
        updatedData.set('inverter', data.inverter);
    if (!updatedData.get('sensors'))
        updatedData.set('sensors', data.sensors);

    ajaxCallPOST("UPDATE", phpfile, updatedData, "",)

}

function deletePV(data) {

    phpfile = "delete.php";

    ajaxCall("DELETE", phpfile, data.id, "", alertSuccessFailure());

}

// this is for create and update
// the request/response should be in json format..
function ajaxCallPOST(request_type, url, data) {

    $(document).ready(function () {
        $.ajax({
            type: request_type,
            url: url,
            data: data,
            processData: false,
            contentType: false,
            success: alertSuccessFailure
        });
    });

}

// this is for load and delete
function ajaxCall(request_type, url, data, dataType, fun) {

    $(document).ready(function () {
        $.ajax({
            type: request_type,
            url: url,
            data: data,
            dataType: dataType,
            success: fun
        });
    });

}

function prunePoints(pv) {

    var prune_marker = new PruneCluster.Marker(lat, lon);

    prune_marker.data.id = pv.id;
    prune_marker.data.name = pv.name;
    prune_marker.data.photo = pv.photo;
    prune_marker.data.coordinates = "(" + pv.lat + ", " + pv.lon + ")";
    prune_marker.data.location = pv.location;
    prune_marker.data.operator = pv.operator;
    prune_marker.data.commission = pv.commission;
    prune_marker.data.description = pv.description;
    prune_marker.data.power = pv.power + " kWp";
    prune_marker.data.production = pv.production + " kWp";
    prune_marker.data.cO2 = pv.cO2 + " tons per annum";
    prune_marker.data.reimbursement = pv.reimbursement + " euro";
    prune_marker.data.modules = pv.modules;
    prune_marker.data.azimuth = pv.azimuth + "°";
    prune_marker.data.inclination = pv.inclination + "°";
    prune_marker.data.communication = pv.communication;
    prune_marker.data.inverter = pv.inverter;
    prune_marker.data.sensors = pv.sensors;

    pruneCluster.RegisterMarker(prune_marker);
    mymap.addLayer(pruneCluster);

}
