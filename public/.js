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