$(document).ready(function () {
    $('#dataTables').DataTable({
        responsive: true,
        lengthMenu: [5, 10, 15, 20, 25, 30, 40, 50, 70, 100, 150],
        language: {
            url: '/www/media/dataTables/i18n/dataTables.czech.lang'
        },
        "aoColumns": $(this).find('thead tr th').map(
                function () {
                    return $(this).data();
                }
        ),
        initComplete: function () {

        }
    });
});