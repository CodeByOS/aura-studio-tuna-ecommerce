// .zap/scripts/auth.js
// Handles Laravel login form authentication for ZAP

function authenticate(helper, paramsValues, credentials) {
    let loginUrl = paramsValues.get("loginUrl");
    let csrfUrl  = paramsValues.get("csrfUrl");

    // Step 1: GET the login page to grab the CSRF token
    let loginPageMsg = helper.prepareMessage();
    loginPageMsg.setRequestHeader(
        loginPageMsg.getRequestHeader().getPrimeHeader() + "\r\n"
    );
    let loginPage = helper.sendAndReceive(csrfUrl);
    let responseBody = loginPage.getResponseBody().toString();

    // Step 2: Extract _token from the HTML
    let tokenMatch = responseBody.match(/name="_token"\s+value="([^"]+)"/);
    let csrfToken  = tokenMatch ? tokenMatch[1] : "";

    // Step 3: POST credentials with CSRF token
    let postData =
        "_token=" + encodeURIComponent(csrfToken) +
        "&email=" + encodeURIComponent(credentials.getParam("username")) +
        "&password=" + encodeURIComponent(credentials.getParam("password"));

    let msg = helper.prepareMessage();
    msg.setRequestHeader(
        "POST " + loginUrl + " HTTP/1.1\r\n" +
        "Host: localhost:8000\r\n" +
        "Content-Type: application/x-www-form-urlencoded\r\n" +
        "Content-Length: " + postData.length + "\r\n"
    );
    msg.setRequestBody(postData);
    helper.sendAndReceive(msg);
    return msg;
}

function getRequiredParamsNames() {
    return ["loginUrl", "csrfUrl"];
}

function getOptionalParamsNames() {
    return [];
}

function getCredentialsParamsNames() {
    return ["username", "password"];
}