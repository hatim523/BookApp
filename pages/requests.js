`
  Parameter Description:
      url:string                  --> url location to get/post data
      body:FormData object        --> containing form data to send over to server
      success_callback: function  --> Function called when request is successful i.e. status = true (HttpResponseStatus = 200)
      error_callback: function    --> Function called when request is unsuccessful i.e. status = false  (HttpResponseStatus = 200)
`

let reqHeader = new Headers();

function post_request(url, body, success_callback, error_callback) {
    `
        Description: Sends a POST Ajax call to server
        Callback Requirements: Should accept data (json)
    `

    let initObject = {
        method: 'POST',
        headers: reqHeader,
        body: body
    };

    let userRequest = new Request(url, initObject);
    request_helper(userRequest, success_callback, error_callback);
}

function get_request(url, body, success_callback, error_callback) {
    `
        Description: Sends a GET Ajax call to server
        Callback Requirements: Should accept data (json)
    `
    let initObject = {
        method: 'GET',
        headers: reqHeader,
        body: body
    };

    let userRequest = new Request(url, initObject);
    request_helper(userRequest, success_callback, error_callback);
}

function request_helper(userRequest, successCallback, errorCallback) {
    fetch(userRequest)
        .then((response) => {
            console.log("Request success");
            let resp_data = response.json();

            resp_data
                .then((resp) => {
                    resp['status'] === true ? successCallback(resp) : errorCallback(resp);
                })
                .catch((err) => {
                    console.log(err);
                })

        })
        .catch((err) => {
            console.log(err);
        })
}