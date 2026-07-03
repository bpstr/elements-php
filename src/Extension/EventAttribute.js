function loadXMLDoc(callback, target, attributes) {
    var defaults = {};
    var params = Object.assign({}, defaults, attributes || {});
    var query = Object.keys(params).map(function(key) {
        return encodeURIComponent(key) + "=" + encodeURIComponent(params[key]);
    }).join("&");
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState === XMLHttpRequest.DONE) {   // XMLHttpRequest.DONE == 4
            if (xmlhttp.status === 200) {
                document.getElementById(target).innerHTML = xmlhttp.responseText;
            }
        }
    };

    xmlhttp.open("GET", "ENDPOINT" + callback + (query ? "?" + query : ""), true);
    xmlhttp.send();
}

/* loadXMLDoc('test_id', 'Bpstr\\Elements\\Html\\Element'); */
