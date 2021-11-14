$(document).on('click', '.btn-edit', function(){
    $( "#form-employee" ).show();
    const id= $(this).attr("id");
    $.ajax({
        url:"data_employee.php",
        method:"POST",
        data:{id:id},
        success:function(data){
            const dataJson = JSON.parse(data);
            const formEditEmployee = `
            <div class="form-layout">
                <button class="close"><img src="./img/close.svg"></button>
                <form method="post" action="../teste_nano_incube/edit_employee.php">
                    <p class="title">Edição de Funcionário</p>
                    <p>
                        <input type="hidden" name="id" value="${dataJson.id}"/>
                    </p>
                    <p>
                        <label for="nome_completo">Nome Completo</label><br>
                        <input type="text" name="nome_completo" id="nome_completo" value="${dataJson.nome}"/>
                    </p>
                    <p>
                        <label for="login">Login</label><br>
                        <input type="text" name="login" id="login" value="${dataJson.login}"/>
                    </p>
                    <p>
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password" value="${dataJson.senha}"/>
                    </p>
                    <input class="btn-action-form" type="submit" value="Editar">
                </form>
            </div>`
            const validation = $('#form-employee');
            if(validation.empty()){
                $('#form-employee').append(formEditEmployee);
            }

            $(document).on('click', '.close',function(){
                $( "#form-employee" ).hide();
            })
            
        }
    })

})