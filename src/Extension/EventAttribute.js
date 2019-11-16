function loadXMLDoc(target, callback, attributes) { // @todo attributes json
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
            if (xmlhttp.status === 200) {
                document.getElementById(target).innerHTML = xmlhttp.responseText;
            }
            else if (xmlhttp.status === 400) {
                console.log('Some serious fuckup has been detected.');
            }
            else {
                console.log('Weird magic happens here - ' + xmlhttp.status);
            }
        }
    };

    xmlhttp.open("GET", "ENDPOINT" + callback + '?' + attributes, true);
    xmlhttp.send();
}

/* loadXMLDoc('test_id', 'Bpstr\\Elements\\Html\\Element'); */
