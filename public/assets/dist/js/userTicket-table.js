$(document).ready(function() {
    $(function () {
        
        var table = $('#userTicket-table').DataTable({
            processing: true,
            serverSide: true,
            /*ordering: false,*/
            iDisplayLength: 25,
            retrieve: true,
            responsive: true,
            searching: true,

            ajax: {
                url: route_registros,

                data: function (d) {
                    d.status = $('#status').val(),
                    d.priority_id = $('#priority_id').val(),
                    d.type_id = $('#type_id').val(),
                    d.assigned = $('#assigned').val(),
                    d.from_date = $('#from_date').val(),
                    d.until_date = $('#until_date').val()
                },
            },
            
            columns: [

                {data: 'actions',
                    name: 'actions',
                    orderable: false, 
                    searchable: false,
                },
                {data: 'uuid', name: 'uuid'},
                {data: 'title', name: 'title'},
                {data: 'status', name: 'status'},
                {data: 'priority_name' , name: 'priorities.name'},
                {data: 'type_name' , name: 'types.name'},
                {data: 'created_at' , name: 'created_at'},

                
            ],

            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            }  
        }); 
        
        $('#search').click(function(){
            table.draw();
        });
    });

});