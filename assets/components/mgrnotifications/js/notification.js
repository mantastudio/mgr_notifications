$(document).ready(function () {
    console.log("ready!");
    $.ajax({
        url: mgrnotifications_URL,
        type: 'POST',
        dataType: 'json',
        headers: {
            'modAuth': MODx.siteId,
        },
        contentType: 'application/json; charset=utf-8',
        success: function (result) {
            if (result && result.success) {
                $("body").prepend(
                    "<div id='mgrnotifications' "
                    + "class='" + result.results[0].Class + "'"
                    + "style=''>"
                    + "<strong>"
                    + result.results[0].Title
                    + ":</strong> "
                    + result.results[0].Message + "</div>"
                );
            } else {
                console.log("Notification Module: No notifications");
            }
        },
        error: function (error) {
            console.log("Notification Module: " + error.toString());
        }
    });
});