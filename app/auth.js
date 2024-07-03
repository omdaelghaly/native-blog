function loadPage(url, elementId, method, data) {

    $.ajax({
        url: url,
        method: method,
        data: data,
        success: function(response) {
            $('#' + elementId).html(response);
        },
        error: function(xhr, status, error) {
            console.error('Error loading page:', error);
        }
    });
}

