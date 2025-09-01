$(document).ready(function() {
    $(function () {
        
        var table = $('#tabla').DataTable({
            processing: true,
            serverSide: true,
            /*ordering: false,*/
            iDisplayLength: 25,
            retrieve: true,
            ajax: route_registros,
            columns: [

                {data: "id", name: 'id'},
                {data: 'first_name', name: 'first_name'},
                {data: 'document_number' , name: 'document_number'},
                {data: 'email', name: 'email'},
                {data: 'username', name: 'username'},
                {data:'start_date', name:'start_date'},
            ],
        });
        
    });
});