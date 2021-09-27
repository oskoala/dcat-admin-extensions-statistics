function httpPost(url, params = "") {
    let httpRequest = new XMLHttpRequest();
    httpRequest.open("POST", url, true);
    httpRequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    httpRequest.send(params);
    httpRequest.onreadystatechange = () => {
        if (httpRequest.readyState === 4 && httpRequest.status === 200) {
            return JSON.parse(httpRequest.responseText);
        }
    }
}


let screen_width = window.screen.width
let screen_height = window.screen.height
let path = window.location.pathname
let referrer = document.referrer

httpPost("/statistics", "screen_width=" + screen_width
    + "&screen_height=" + screen_height
    + "&_token=" + "{{csrf_token()}}"
    + "&path=" + path
    + "&referrer=" + referrer
)
