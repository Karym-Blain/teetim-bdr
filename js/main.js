/** Code Js pour le catalogue */

//Gestion du formualire de tri et de filtre
document.querySelectorAll( "form.controle select").forEach(
    eltSelect => eltSelect.addEventListener("change",
        evt => evt.target.from.submit()
    )
);