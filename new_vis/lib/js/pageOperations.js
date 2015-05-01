function pageHeight() {
    var lReturn = window.innerHeight;
    if (typeof lReturn == "undefined") {
        if (typeof document.documentElement != "undefined" && typeof document.documentElement.clientHeight != "undefined") {
            lReturn = document.documentElement.clientHeight;
        } else if (typeof document.body != "undefined") {
            lReturn = document.body.clientHeight;
        }
    }
    return lReturn;
}

// method to get page width
function pageWidth() {
    var lReturn = window.innerWidth;
    if (typeof lReturn == "undefined") {
        if (typeof document.documentElement != "undefined" && typeof document.documentElement.clientWidth != "undefined") {
            lReturn = document.documentElement.clientWidth;
        } else if (typeof document.body != "undefined") {
            lReturn = document.body.clientWidth;
        }
    }
    return lReturn;
}