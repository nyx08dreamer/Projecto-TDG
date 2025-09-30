$(document).ready(function() {
    $(function () {
        
        var table = $('#rolePermissions-table').DataTable({
            processing: true,
            serverSide: true,
            /*ordering: false,*/
            iDisplayLength: 25,
            retrieve: true,
            ajax: {
                url: rolePermissions_registros,
                data: { type: 'permissions' }
            },
            responsive: true,
            columns: [

                {data: 'name', name: 'name'},
                {data: 'description' , name: 'description'},

            ],

            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }  
        });        
    });

    
});