document.addEventListener('DOMContentLoaded', function(){
    var sidenav = document.querySelectorAll('.sidenav');
    var el = document.querySelectorAll('.tabs');
    var dropdown = document.querySelectorAll('.dropdown-trigger');
    var nvForn = document.getElementById('novo-forn');
    var nvProd = document.getElementById('novo-prod');
    var nvTransp = document.getElementById('novo-transp');

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

async function editarFilme(id){
    //var edtFilme = document.getElementById('modal-editar-fornecedor');
    var dados = await fetch('/controle/editar/' + id)
    var resposta = await dados.json();
    console.log(JSON.parse(resposta));
    //console.log("Entrou na função")

    // var instances_edtFilme = M.Modal.init(edtFilme)

    // document.getElementById("id-edt").value = resposta['dados'][0].id
    // document.getElementById("titulo-edt").value = resposta['dados'][0].titulo
    // document.getElementById("url-poster-edt").value = resposta['dados'][0].poster
    // document.getElementById("sinopse-edt").value = resposta['dados'][0].sinopse
    // document.getElementById("nota-edt").value = resposta['dados'][0].nota
    // document.getElementById("url-edt").value = resposta['dados'][0].url
    // document.getElementById("chave-trailer-edt").value = resposta['dados'][0].trailer
    // document.getElementById("back-1-edt").value = resposta['dados'][0].img_wide_1
    // document.getElementById("back-2-edt").value = resposta['dados'][0].img_wide_2
    // document.getElementById("back-3-edt").value = resposta['dados'][0].img_wide_3

    // instances_edtFilme.open()
}
