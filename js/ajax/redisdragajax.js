"use strict";

var redips_init,		// definir la variable redips_init
initXMLHttpClient,	// crear XMLHttp request object in a cross-browser manner
send_request,		// send AJAX request
request,			// XMLHttp request object
print_message,           // print message
report,			// function shows subject occurring in timetable
report_button,	// show/hide report buttons
show_all,
div_nl;		// function show all subjects in timetable
        
var logitud_id=6;
        		


// redips initialization
redips_init = function () {
    // reference to the REDIPS.drag object
    var	rd = REDIPS.drag;
    // create XMLHttp request object
    request = initXMLHttpClient();
    // REDIPS.drag initialization
    //rd.init();
    rd.init('drag1');
    rd.init('drag2');
    rd.init('drag4');
    rd.init('drag3');
    rd.drop_option = 'single';		// dragged elements can be placed to the empty cells only
    rd.hover.color_td = '#9BB3DA';	// set hover color
        
    
    // save - after element is dropped
    rd.myhandler_dropped = function () {
        // get element position (method returns array with current and source positions - tableIndex, rowIndex and cellIndex)
        var pos = rd.get_position();
        // save table content
        send_request('index.php/reservaciones_fijas/guardarhorario?p=' + rd.obj.id + '_' + pos.join('_'));
        //print_message('Se ha actualizado la tabla de reservaciones...'+ rd.obj.id + '_' + pos.join('_'));
           
    };
    // delete - after element is deleted
    rd.myhandler_deleted = function () {
        // get element position
        var pos = rd.get_position(),
        row = pos[4],
        col = pos[5];
        // delete element
        send_request('index.php/reservaciones_fijas/eliminarhorario?p=' + rd.obj.id + '_' + row + '_' + col);
       // print_message('Horario eliminado de la tabla de reservaciones...'+ rd.obj.id + '_' + row + '_' + col);
       
    };
    rd.myhandler_clicked = function () {
        
    };
    // print message to the message line
    //print_message('Los cambios realizados en la tabla de tiempos de reservaciones fijas serán guardados inmediatamente...');
};


// XMLHttp request object
initXMLHttpClient = function () {
    var XMLHTTP_IDS,
    xmlhttp,
    success = false,
    i;
    // Mozilla/Chrome/Safari/IE7/IE8 (normal browsers)
    try {
        xmlhttp = new XMLHttpRequest(); 
    }
    // IE (?!)
    catch (e1) {
        XMLHTTP_IDS = [ 'MSXML2.XMLHTTP.5.0', 'MSXML2.XMLHTTP.4.0',
        'MSXML2.XMLHTTP.3.0', 'MSXML2.XMLHTTP', 'Microsoft.XMLHTTP' ];
        for (i = 0; i < XMLHTTP_IDS.length && !success; i++) {
            try {
                success = true;
                xmlhttp = new ActiveXObject(XMLHTTP_IDS[i]);
            }
            catch (e2) {}
        }
        if (!success) {
            throw new Error('Unable to create XMLHttpRequest!');
        }
    }
    return xmlhttp;
};


// function sends AJAX request to the server (save or delete)
// input parameter is complete URL of service with query string 
send_request = function (url) {
    // open asynchronus request
    request.open('GET', url, true);
    // the onreadystatechange event is triggered every time the readyState changes
    request.onreadystatechange = function () {
        //  request finished and response is ready
        if (request.readyState === 4) {
            // if something went wrong
            if (request.status !== 200) {
                // display error message
                //document.getElementById('message').innerHTML = 'Error: [' + request.status + '] ' + request.statusText;
            }
        }
    };
    // send request
    request.send(null);
};






// add onload event listener
if (window.addEventListener) {
    window.addEventListener('load', redips_init, false);
}
else if (window.attachEvent) {
    window.attachEvent('onload', redips_init);
}