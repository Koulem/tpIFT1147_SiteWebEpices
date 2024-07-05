let langueActuelle = null;
let fichierXML = null;

function traduire(section){
    localStorage.getItem("xmlStringLangue");
    const parser = new DOMParser();
    fichierXML = parser.parseFromString(localStorage.getItem("xmlStringLangue"), "application/xml");
    var codes=fichierXML.getElementsByTagName(section)[0];
    //alert(codes.firstChild.nodeName);

    var elem=codes.firstChild;
    while(elem!=null){//parcourrir toutes les balise
       while (elem.nodeType==3){//#text
           elem=elem.nextSibling;
       }
       if (elem!=null){
           code=elem.nodeName;//alert(elem.firstChild.nodeValue);
           contenu=elem.firstChild.nodeValue;
           document.getElementById(code).innerHTML=contenu;
           elem=elem.nextSibling;
       }
    }
   }

let obtenirXML = (langue) => {
    langueActuelle = langue;
    fetch("serveur/langues/"+langue+".xml")
        .then(reponse => reponse.text())
        .then(xmlString => {//alert(xmlString);
            localStorage.setItem("xmlStringLangue",xmlString);
            traduire("accueil");
    })
        .catch(console.error);
}