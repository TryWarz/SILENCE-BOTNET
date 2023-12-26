<?php

// Function to sanitize HTML input
function htmlsc($string) {
    return htmlspecialchars($string, ENT_QUOTES, "UTF-8");
}

function throwError($reason) {
    $error_response["error"] = true;
    $error_response['reason'] = $reason;
    http_response_code(400);
    exit(json_encode($error_response));
}