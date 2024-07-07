let imagesURL = null;
let provenanceAppel = null;
let listeEpices = null;
let listeCategories = null;

let remplirCard = uneEpice => {
    let rep = ' <div class="col-sm-3 maCard">'
    rep += '<div class="card">'
    rep +=
        ' <img src="' + imagesURL +
        uneEpice.images +
        '"  class="card-img-top img-fluid" alt="...">'
    rep += ' <div class="card-body">'
    rep += ' <h5 class="card-title">' + uneEpice.nom + '</h5>'
    rep +=
        ' <p class="card-text">' +
        uneEpice.descriptions.substring(0, 30) +
        '...</p>'
    rep += ' <p class="card-text">' + uneEpice.prix + '$</p>'
    if (provenanceAppel == 'M') {
        rep +=
            ' <a href="#" onClick="ajouterPanier(' + uneEpice.ide + ');"><i class="bi bi-cart-plus panierPlus"></i></a>'
    }
    rep += ' </div>'
    rep += ' </div>'
    rep += ' </div>'
    return rep
}

let listerEpices = () => {
    let contenu = `<div class="row">`
    for (let uneEpice of listeEpices) {
        contenu += remplirCard(uneEpice)
    }
    contenu += `</div>`
    $('#contenu').html(contenu) //document.getElementById('contenu').innerHTML=contenu;
}

let listerCategories = () => {
  let leSel = document.getElementById('selCategs');
  let rep="";
  for(let unType of listeCategories){
     rep+=`<li><a class="dropdown-item" href="javascript:obtenirXML('${unType.substring(0,3)}');">${unType}</a></li>`;
  }
  leSel.innerHTML=rep;
}

let listerCategoriesForm = () => {
  let leSel = document.getElementById('categ');
  for(let unType of listeCategories){
      if(unType !== "Toutes"){
        leSel.options[leSel.options.length] = new Option(unType, unType.substring(0,3).toLowerCase());
      }
  }
}

//allerURL contient le url où se trouve le fichier liste.php
//Provenance si l'Appel provient de index.php ou membres.php
//imagesURL selon la provenance contiendra le bon chemin où se trouve les images des articles

let chargerEpices = (provenance, allerURL) => {
    //allerURL ="./serveur/gestionEpice/listerEpice.php";
    provenanceAppel = provenance;
    imagesURL = (provenance == 'I') ? "serveur/photos/" : "../photos/";
    $.ajax({
        type: 'POST',
        url: allerURL,
        dataType: 'json',
        success: reponse => {
            if (reponse.OK) {
                listeEpices = reponse.listeEpices;
                listeCategories = reponse.categories;
                if(provenance == "I" || provenance == "M"){
                    listerCategories();
                    listerEpices();
                }else {// A-Admmin
                    listerCategories();
                    listerCategoriesForm();
                    genererPagination(); //À partir de listeEpices
                }
            }
        },
        fail: e => {
            alert('Problème avec votre requête')
        }
    })
}