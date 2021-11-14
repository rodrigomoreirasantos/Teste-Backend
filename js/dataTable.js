$(document).ready(function() { 
    fetch_data();
    function fetch_data(){
        const dataTable = $('#all-list-employee').DataTable({			
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "seach_employee.php",
                type: "POST"
            }
        });
    }


    //Ações de Botões
    $(document).on('click', '.btn-delete', function(){
        const id = $(this).attr("id");
        if(confirm("Você tem certeza que deseja deletar?")){
            $.ajax({
                url:"delete.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                    $('#alert-message').html('<div class="alert">'+data+'</div>');
                    $('#all-list-employee').DataTable().destroy();
                    fetch_data();
                }
            })
        }
    });

    $(document).on('click','.btn-statemen', function(){
        const id = $(this).attr("id");
        $.ajax({
            url:"new_statement.php",
            method:"POST",
            data:{id:id},
            success:function(data){
                console.log(data);
                $.ajax({
                    url:"money_employee.php",
                    method:"POST",
                    data:{id:id},
                    success: function(data){
                        console.log(data)
                    }
                })
            }
        })
        
       
        //$('#all-list-statetment').DataTable().destroy();
        //fetch_statement();
    })

    $('#all-list-statetment').hide();
    $(document).on('click', '.btn-view', function(){ 
        const id = $(this).attr("id");
        function fetch_statement(){
            const dataTableStatetment = $("#all-list-statetment").DataTable({
                "processing":true,
                "serverSide":true,
                "ajax":{
                url:"seach_statement.php",
                type: "POST",
                data:{id:id}
                }
            });
        }
        $('#all-list-statetment').DataTable().destroy()
        fetch_statement();
        $('#all-list-statetment').show();

       
    })


} );

