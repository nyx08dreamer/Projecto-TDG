var support = function(url){
    var mbody = $('#ItSupport').find('.modal-body');
    mbody.html('');
    $('#ItSupport').modal('show');

    if ($('#ItSupport').find('.modal-body').children().length == 0) {  
        $("#spinner-ItSupport").show()
        $.ajax({
            url: url,
            type: 'GET',
            success:function(data){
                table = `
                    <tr>
                        <td class="text-bold-500">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="user_id" id="user_id" value="" onclick="selected_It_Support('','0', 'PROVEEDOR POR DEFINIR', '0')">
                            </div>
                        </td>
                        <td></td>
                        <td></td>
                        <td class="text-bold-500">PROVEEDOR POR DEFINIR</td>
                        <td></td>
                    </tr>
                `

                for (i=0; i < data.length; i++) {
                    table = table + `
                    
                    <tr>
                            <td class="text-bold-500">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="user_id" id="user_id" value="`+data[i]['id']+`" onclick="selected_It_Support('`+data[i]['id']+`','`+data[i]['first_name']+`','`+data[i]['last_name']+`','`+data[i]['document_number']+`','`+data[i]['email']+`' )">
                                </div>
                            </td>
                            <td class="text-bold-500">`+data[i]['first_name']+`</td>
                            <td class="text-bold-500">`+data[i]['last_name']+`</td>
                            <td class="text-bold-500">`+data[i]['document_number']+`</td>
                            <td class="text-bold-500">`+data[i]['email']+`</td>
                        </tr>
                    `
                }

                $("#spinner-ItSupport").hide();
                mbody.append(`
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover" id="ItSupport-table">
                                            <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>Nombre</th>
                                                    <th>Apellido</th>
                                                    <th>Cedula de Identidad</th>
                                                    <th>Correo Electronico</th>
                                                </tr>
                                            </thead>
                                            <tbody>`
                                                +table+
                                            `</tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                `);

                new DataTable('#ItSupport-table', {
                    language: {
                            url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
                        },
                });

                
            }
        })
    }
}

var selected_It_Support = function(id, first_name, last_name, document_number, email){
    $('#user_id').val(id);
    $('#first_name').val(first_name);
    $('#last_name').val(last_name);
    $('#document_number').val(document_number);
    $('#email').val(email);
    $('#ItSupport').modal('hide');
}