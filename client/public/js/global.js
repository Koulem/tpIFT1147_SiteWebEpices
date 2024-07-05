let validerFormEnreg = () => {
  let etat = true;
  //const regExpPass = new RegExp('^[A-Za-z0-9_\$#\-]{6,10}$');
  const mdp = document.getElementById('mdp').value;
  const mdpc = document.getElementById('mdpc').value;
  if(mdp !== mdpc){
      etat = false;
      document.getElementById('msgPass').innerHTML = "Mots de passe ne sont pas égaux !";
      setInterval(() => {
          document.getElementById('msgPass').innerHTML = "";
      },3000);
  } //else {//OK, égaux
  //     if(!regExpPass.test(mdp)){
  //          etat = false;
  //         document.getElementById('msgPass').innerHTML = "Mot de passe non conforme";
  //     }
  
  return etat;
}
const montrerToast = (msg) => {
	if(msg.length > 0){
		let textToast = document.getElementById("textToast");
		var toastElList = [].slice.call(document.querySelectorAll('.toast'))
		var toastList = toastElList.map(function (toastEl) {
			return new bootstrap.Toast(toastEl)
		})
		textToast.innerHTML = msg;
		toastList[0].show();
	}
}