$(function () {
    $('.morris').each(function () {
        _config = $(this).data();

        if (_config.name === "Bar") {
            Morris.Bar({
                element: 'morris-bar-chart-type-' + _config.type,
                xkey: _config.xkey,
                ykeys: _config.ykeys,
                labels: _config.label,
                hideHover: 'auto',
                resize: true,
                data: _config.data
            });
        } else if (_config.name === "Line") {
            Morris.Line({
                element: 'morris-bar-chart-type-' + _config.type,
                xkey: _config.xkey,
                ykeys: _config.ykeys,
                labels: _config.label,
                hideHover: 'auto',
                resize: true,
                parseTime: false,
                data: _config.data
            });
        }
    });
});
