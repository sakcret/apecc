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
    rd.init();
    rd.drop_option = 'single';		// dragged elements can be placed to the empty cells only
    rd.hover.color_td = '#9BB3DA';	// set hover color
        
    div_nl = document.getElementById('table2').getElementsByTagName('div');
	report_button();
    // save - after element is dropped
    rd.myhandler_dropped = function () {
        // get element position (method returns array with current and source positions - tableIndex, rowIndex and cellIndex)
        var pos = rd.get_position();
        // save table content
        send_request('index.php/reservaciones_fijas/guardarhorario?p=' + rd.obj.id + '_' + pos.join('_'));
        print_message('Se ha actualizado la tabla de reservaciones...'+ rd.obj.id + '_' + pos.join('_'));
        report_button();    
    };
    // delete - after element is deleted
    rd.myhandler_deleted = function () {
        // get element position
        var pos = rd.get_position(),
        row = pos[4],
        col = pos[5];
        // delete element
        send_request('index.php/reservaciones_fijas/eliminarhorario?p=' + rd.obj.id + '_' + row + '_' + col);
        print_message('Horario eliminado de la tabla de reservaciones...'+ rd.obj.id + '_' + row + '_' + col);
        report_button();
    };
    rd.myhandler_clicked = function () {
        show_all();
    };
    // print message to the message line
    print_message('Los cambios realizados en la tabla de tiempos de reservaciones fijas serán guardados inmediatamente...');
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
                document.getElementById('message').innerHTML = 'Error: [' + request.status + '] ' + request.statusText;
            }
        }
    };
    // send request
    request.send(null);
};

report = function (subject,name) {
    // definir etiquetas de dia y hora
    var day = ['Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    time = ['07:00','08:00', '09:00', '10:00', '11:00', '12:00',
    '13:00', '14:00', '15:00', '16:00','17:00', '18:00','19:00'],
    div = [],	// definir celda
    cellIndex,	// indice de columna
    rowIndex,	// indice de fila
    id,			// id del elemento
    i,			// iterador
    num = 0,	// numero de horarios para al materia seleccionada 
    str = '';	// result string
    //ver todos los elementos
    show_all();	
    for (i = 0; i < div_nl.length; i++) {
        div[i] = div_nl[i];
    }
    // sort div elements by the cellIndex (days in week) and rowIndex (hours)
    div.sort(function (a, b) {
        var a_ci = a.parentNode.cellIndex,				// a element cell index
        a_ri = a.parentNode.parentNode.rowIndex,	// a element row index
        b_ci = b.parentNode.cellIndex,				// b element cell index
        b_ri = b.parentNode.parentNode.rowIndex;	// b element row index
        return a_ci * 100 + a_ri - (b_ci * 100 + b_ri);
    });
    // loop goes through all collected elements
    for (i = 0; i < div.length; i++) {
        // define only first two letters of ID
        // (cloned elements have appended c1, c2, c3 ...)
        id = div[i].id.substr(0, logitud_id);
        // if id is equal to the passed subject then we have a match
        if (id === subject) { 
            // define cell index
            cellIndex = div[i].parentNode.cellIndex;
            // table row is parent element of table cell 
            rowIndex = div[i].parentNode.parentNode.rowIndex;
            // add line with found element
            str += day[cellIndex - 1] + '\t\t' + time[rowIndex - 1] + '\n';
            // increase counter
            num++;
        }
        // other elements should be hidden
        else {
            div[i].style.visibility = 'hidden';
        }
    }
    // if "Show report" is checked then show message
    if (document.getElementById('report').checked === true) {
        alert('Horario para la materia "'+name+'" : ' +'\n' +'Presente en('+num+') dias.'+'\n'+'\n' + str);
    }
};


// show/hide report buttons
report_button = function () {
    var	id,			// element id
    i,			// loop variable
    count,		// number of subjects in timetable
    style,		// hidden or visible
    // prepare subjects
    subject = 
    {
       
        
    };
    // loop goes through all collected elements
    for (i = 0; i < div_nl.length; i++) {
        // define only first two letters of ID
        // (cloned elements have appended c1, c2, c3 ...)
        id = div_nl[i].id.substr(0, logitud_id);
        // increase subject occurring
        subject[id]++;
    }
    // loop through subjects
    for (i in subject) {
        // using the hasOwnProperty method to distinguish the true members of the object
        if (subject.hasOwnProperty(i)) {
            // prepare id of the report button
            id = 'b_' + i;
            // subject count on the timetable
            count = subject[i];
            if (count === 0) {
                style = 'hidden';
            }
            else {
                style = 'visible';
            }
            // hide or show report button
            document.getElementById(id).style.visibility = style;
        }
    }
};


// function show all subjects in timetable
show_all = function () {
    var	i; // loop variable
    for (i = 0; i < div_nl.length; i++) {
        div_nl[i].style.visibility = 'visible';
    }
};


// print message
print_message = function (message) {
    document.getElementById('message').innerHTML = message;
};


// add onload event listener
if (window.addEventListener) {
    window.addEventListener('load', redips_init, false);
}
else if (window.attachEvent) {
    window.attachEvent('onload', redips_init);
}