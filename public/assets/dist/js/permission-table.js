$(document).ready(function() {
    $(function () {
        
        var table = $('#permission-table').DataTable({
            processing: true,
            serverSide: true,
            /*ordering: false,*/
            iDisplayLength: 25,
            retrieve: true,
            ajax: route_registros,
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