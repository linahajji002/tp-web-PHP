$(document).ready(function() {
    $('#dataTable').DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "dom": 'Bfrtip',
        "buttons": [
            'copy', 'excel', 'csv', 'pdf'
        ]
    });
});