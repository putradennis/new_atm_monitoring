$(document).ready(function(){

    var url;
    url = baseURL + "postilion/ajaxcontroller/saldo_terminal_crm";
    // alert(url);

    var table_batch_viewer_crm = $('#datatable_saldo_crm').DataTable({
        iDisplayLength:50,
        processing: true,
        // serverSide: true,
        searching: true,
        ajax: {
            url : url,
            data: {
                // terminal_name : function() {return $('#terminal_batch').val()},
                datebatch : function() {return $('#sdatecutoffsaldo').val()}
            },
            type : 'GET'
        },
        language: {
            // "processing": "Loading. Please wait..."
            "processing": '<div class="loader"><div class="m-t-30"><img class="zmdi-hc-spin" src="'+baseURL+'assets/images/loader.svg" width="48" height="48" alt="Aero"></div><p>Processing...</p></div>'
            
        },
    });

    $( "#btn_submit_posti_saldo_crm" ).click(function() {
        table_batch_viewer_crm.ajax.reload();
    });

        
        

});