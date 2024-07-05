
let deconnecter = () => {
    //fetch('serveur/pages/deconnecter.php').then(alert("FINI"));
    document.getElementById('formDec').submit();//'dc'
}


let validerFormEnreg = () => {
    let pass = document.getElementById('mdp').value;//'pass'
    let cpass = document.getElementById('mdpc').value;//'cpass'
    if (pass === cpass) {
        return true;
    } else {
        return false;
    }
}

function rendreVisible(elem){
	document.getElementById(elem).style.display='block';
}

function rendreInvisible(elem){
	document.getElementById(elem).style.display='none';
}

function lister(){
	document.getElementById('formLister').submit();
}
/*
//--Fonction ajouter mon ajout

function ajouterEpice()
{
	document.getElementById('ide').value=uneEpice.ide;
	document.getElementById('nom').value=uneEpice.nom;
	document.getElementById('types').value=uneEpice.types;
	document.getElementById('prix').value=uneEpice.prix;
	document.getElementById('vendeur').value=uneEpice.vendeur;
	document.getElementById('images_aj').value=uneEpice.images;
	document.getElementById('descr_aj').value=uneEpice.description;
	$('#modalAjouterEpices').modal('show');
}
*/

function validerNum(elem){
	var num=document.getElementById(elem).value;
	var numRegExp=new RegExp("^[0-9]{1,4}$");
	if(num!="" && numRegExp.test(num))
		return true;
	return false;
}

function valider(){
	var ide=document.getElementById('ide').value;//num
	var nom=document.getElementById('nom').value;//titre
	var types=document.getElementById('types').value;//duree
	var vendeur=document.getElementById('vendeur').value;//res
	var ideRegExp=new RegExp("^[0-9]{1,4}$");
	if(ide!="" && nom!="" && types!="" && vendeur!="")
		if(ideRegExp.test(ide))
			return true;
	return false;
}
//EditercEpice
function editerUneEpice(uneEpice){
	document.getElementById('ide_m').value=uneEpice.ide;
	document.getElementById('nom_m').value=uneEpice.nom;
	document.getElementById('types_m').value=uneEpice.types;
	document.getElementById('prix_m').value=uneEpice.prix;
	document.getElementById('vendeur_m').value=uneEpice.vendeur;
	document.getElementById('images_m').value=uneEpice.images;
	document.getElementById('desc_m').value=uneEpice.description;
	$('#modalEditerEpices').modal('show');
}

let ideEpiceSupprimer;

function supprimerEpice(ide){
	ideEpiceSupprimer = ide;
	$('#modalSupprimerEpices').modal('show');
}

function supprimer(){
     let formEnlever = document.getElementById('formEnlever');
	 document.getElementById('idar').value = ideEpiceSupprimer;
	 formEnlever.submit();
}

function enleverMultiplesEpices(){                  
	let listeCheckBoxes = document.getElementsByName("options[]");
	//Vérifier s'il y a au moins une option de cochée;
	let listeEpices="";
	for(let uneOption of  listeCheckBoxes){
		if (uneOption.checked){
			listeEpices+=(uneOption.value+";"); //9;13;50;
		}
	}
	if(listeEpices.length > 0){
		listeEpices=listeEpices.substring(0,listeEpices.length-1);//Enlever dernier ;
		document.getElementById("idaM").value = listeEpices;
		document.getElementById("formEnleverMultiples").submit();
	}
}

$(document).ready(function(){
	// Activate tooltip
	$('[data-toggle="tooltip"]').tooltip();
	
	// Select/Deselect checkboxes
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

let initialiser = (msg) =>{
	if(msg.length > 0){
		let textToast = document.getElementById("textToast");
		let toastElList = [].slice.call(document.querySelectorAll('.toast'))
		let toastList = toastElList.map(function (toastEl) {
			return new bootstrap.Toast(toastEl)
		})
		textToast.innerHTML = msg;
		toastList[0].show();
	}
}

//pour le paginator

var $pagination,
totalRecords = 0,
records = [],
displayRecords = [],
recPerPage = 4,
page = 1,
totalPages = 0;

function genererPagination(){
	$pagination = $('#pagination');
	records = listeEpices;
	//alert(JSON.stringify(records));
	// console.log(records);
	totalRecords = records.length;
	totalPages = Math.ceil(totalRecords / recPerPage);
	apply_pagination();
}

function generate_table() {
    let tr;
    $('#emp_body').html('');
	let rep="";
    for (let uneEpice of displayRecords) { 
		rep+=`
			<tr>
				<td>
					<span class="custom-checkbox">
						<input type="checkbox" id="opt" value="${uneEpice.ide}" name="options[]">
						<label for="opt"></label>
					</span>
				</td>	
				<td>${uneEpice.ide}</td>
				<td>${uneEpice.nom}</td>
				<td>${uneEpice.types}</td>
				<td>${uneEpice.prix}</td>
				<td>${uneEpice.vendeur}$</td>
				<td><img class='img-fluid'  width='60' height='60' src='../../photos/${uneEpice.images}'></td>
				<td>${uneEpice.descriptions}</td>
				
				<td>
					<a href="#" onClick='editerUneEpice(`;
				rep+=JSON.stringify(uneEpice);
				rep+=`)' class="edit" data-bs-toggle="modal"><i class="bi bi-pencil" data-toggle="tooltip" title="Modifier"></i></a>
					<a href="#" onClick='supprimerEpice(${uneEpice.ide})' class="delete" data-toggle="modal"><i class="bi bi-trash3" data-toggle="tooltip" title="Enlever"></i></a>
				</td>
			</tr>`;
    }
	$('#emp_body').html(rep);
}	

function apply_pagination() {
    $pagination.twbsPagination({
          totalPages: totalPages,
          visiblePages: 6,
          onPageClick: function (event, page) {
                displayRecordsIndex = Math.max(page - 1, 0) * recPerPage;
                endRec = (displayRecordsIndex) + recPerPage;
               
                displayRecords = records.slice(displayRecordsIndex, endRec);
                generate_table();
          }
    });
}