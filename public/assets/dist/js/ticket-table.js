$(document).ready(function() {
    $(function () {
        
        var table = $('#ticket-table').DataTable({
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
                {data: 'title', name: 'title'},
                {data: 'creator_name', name: 'creator.first_name'},
                {data: 'priority_name' , name: 'priorities.name'},
                {data: 'type_name' , name: 'types.name'},
                {data: 'created_at' , name: 'created_at'},

                
            ],

            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }  
        });        
    });

});