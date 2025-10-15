$(document).ready(function() {
    $(function () {
        
        var table = $('#department-table').DataTable({
            processing: true,
            serverSide: true,
            /*ordering: false,*/
            iDisplayLength: 25,
            retrieve: true,
            ajax: route_registros,
            responsive: true,
            columns: [

                {data: 'actions',
                    name: 'actions',
                    orderable: false, 
                    searchable: false,
                },
                {data: 'name', name: 'name'},
                {data: 'created_at' , name: 'created_at'},
                {data: 'creator_name', name: 'creator.first_name'},
                {data: 'updated_at' , name: 'updated_at'},
                {data: 'updater_name', name: 'updater.first_name'},
                {data: 'flag_status' , name: 'flag_status'},
                
            ],

            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }  
        });        
    });

});