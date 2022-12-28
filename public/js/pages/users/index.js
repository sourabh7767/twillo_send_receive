$(document).on('click', '.delete-datatable-record', function(e){
    let url  = site_url + "/users/" + $(this).attr('data-id');
    let tableId = 'usersTable';
    deleteDataTableRecord(url, tableId);
});

$(document).ready(function() {
    console.log(site_url, '======site_url');
    $('#usersTable').DataTable({
        ...defaultDatatableSettings,
        ajax: site_url + "/users/",
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
            { data: 'phn_number', name: 'phn_number' },
            { data: 'name', name: 'name' },
            { data: 'country', name: 'country' },
            { data: 'created_at', name: 'created_at'},
            { data: 'status', name: 'status'},
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});