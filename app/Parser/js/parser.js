var page = require('webpage').create(),
    system = require('system'),
    url = system.args[1];

page.open(url, function () {
    page.injectJs('jquery-1.12.3.min.js');

    page.onResourceRequested = function (requestData, request) {
        if ((/http:\/\/.+?\.css$/gi).test(requestData['url'])) {
            request.abort();
        }
        if (
            (/\.doubleclick\./gi.test(requestData['url'])) ||
            (/\.pubmatic\.com$/gi.test(requestData['url'])) ||
            (/yandex/gi.test(requestData['url'])) ||
            (/google/gi.test(requestData['url'])) ||
            (/gstatic/gi.test(requestData['url']))
        ) {
            request.abort();
            return;
        }
    };


    var html = page.evaluate(function() {
        return $('body .actions-page').html();

    });

    console.log(html);

    phantom.exit();

});