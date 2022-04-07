document.addEventListener('DOMContentLoaded', function(){
    var sidenav = document.querySelectorAll('.sidenav');
    var el = document.querySelectorAll('.tabs');
    var dropdown = document.querySelectorAll('.dropdown-trigger');
    var nvForn = document.getElementById('form-fornecedor');
    var nvProd = document.getElementById('novo-prod');
    var nvTransp = document.getElementById('novo-transp');

    var tituloTab_prod = document.getElementById('aciona_tab_produto').innerText;
    var tituloTab_forn = document.getElementById('aciona_tab_fornecedor').innerText;
    var tituloTab_transp = document.getElementById('aciona_tab_transportadora').innerText;
    var elem_select = document.querySelectorAll('select');
    var select = M.FormSelect.init(elem_select);
 
    
    var instance = M.Tabs.init(el);

    var instances_sidenav = M.Sidenav.init(sidenav);

    var instances_dropdown = M.Dropdown.init(dropdown, {
        coverTrigger:false,
        hover:true,
        restringirWidth:false,
    });
    M.Modal.init(nvForn);
    M.Modal.init(nvProd);
    M.Modal.init(nvTransp);

});



async function editarFornecedor(id){
    var edtForn = document.getElementById('novo-forn');
   
    var dados = await fetch(`/controle/editar/${id}`)
    
    var resposta = await dados.json()
    console.log(resposta);

     M.Modal.init(edtForn)

     document.getElementById("nome").value = resposta['dados'][0].nome
     document.getElementById("descricao").value = resposta['dados'][0].descricao
     document.getElementById("cidade").value = resposta['dados'][0].cidade
     document.getElementById("endereco").value = resposta['dados'][0].endereco
     document.getElementById("bairro").value = resposta['dados'][0].bairro
     document.getElementById("numero").value = resposta['dados'][0].numero
     document.getElementById("ddd").value = resposta['dados'][0].ddd
     document.getElementById("numero_tel").value = resposta['dados'][0].numero_tel
     document.getElementById("email").value = resposta['dados'][0].email
     document.getElementById("id-fornecedor").value = resposta['dados'][0].id
     document.getElementById("id-telefone").value = resposta['dados'][0].id_tel
     document.getElementById("id-email").value = resposta['dados'][0].id_email
     document.getElementById().id = "atualiza_registros"
     

    edtForn.open()
}

