$(document).on('click', '.btn-statement', function(){
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
                <form method="post" action="../teste_nano_incube/new_statement.php">
                    <p class="title">Cadastro de Movimentação</p>
                    <p>
                        <input type="hidden" name="id" value="${dataJson.id}"/>
                    </p>
                    <p>
                        <label for="nome_completo">Nome Completo</label><br>
                        <input type="text" name="nome_completo" id="nome_completo" disabled="" value="${dataJson.nome}"/>
                    </p>
                    <p>
                        <label for="tipo_movimentacao">Tipo de Movimentação</label><br>
                        <select id="tipo_movimentacao" name="tipo_movimentacao">
                            <option></option>
                            <option value="entrada">Entrada</option>
                            <option value="saida">Saída</option>
                        </select>
                    </p>
                    <p>
                        <label for="valor_movimentacao">Valor</label><br>
                        <input type="number" min="0.00" max="10000.00" step="0.01" name="valor_movimentacao" id="valor_movimentacao" />
                    </p>
                    <p>
                        <label for="observacao_movimentacao">Observação</label><br>
                        <input type="text" name="observacao_movimentacao" id="observacao_movimentacao" />
                    </p>
                    <input class="btn-action-form" type="submit" value="Cadastrar Movimentação">
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