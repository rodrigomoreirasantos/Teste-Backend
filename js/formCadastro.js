$(document).on('click', '.add-employee', function(){
    $( "#form-employee" ).show();
    const formEmployee = `
    <div class="form-layout">
        <button class="close"><img src="./img/close.svg"></button>
        <form id="register-employee" method="post" action="../teste_nano_incube/register_employee.php">
            <p class="title">Cadastro de Funcionário</p>
            <p>
                <label for="nome_completo">Nome Completo</label><br>
                <input type="text" name="nome_completo" id="nome_completo" />
            </p>
            <p>
                <label for="login">Login</label><br>
                <input type="text" name="login" id="login" />
            </p>
            <p>
                <label for="password">Password</label><br>
                <input type="password" name="password" id="password" />
            </p>
            <input class="btn-action-form" type="submit" value="Cadastrar">
        </form>
    </div>`

    const validation = $('#form-employee');
    if(validation.empty()){
        $('#form-employee').append(formEmployee);
    }

    $(document).on('click', '.close',function(){
        $( "#form-employee" ).hide();
    })
    
})

