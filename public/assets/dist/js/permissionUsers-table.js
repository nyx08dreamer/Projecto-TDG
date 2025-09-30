$(document).ready(function() {
    $(function () {
        
        var table = $('#permissionsUsers-table').DataTable({
            processing: true,
            serverSide: true,
            /*ordering: false,*/
            iDisplayLength: 25,
            retrieve: true,
            ajax: {
                url: permissionUsers_registros,
                data: { type: 'users' }
            },
            responsive: true,
            columns: [

                { data: 'full_name', name: 'full_name' },
                {data: 'username' , name: 'username'},
                {data: 'email' , name: 'email'},
            ],

            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }  
        });        
    });

    
});