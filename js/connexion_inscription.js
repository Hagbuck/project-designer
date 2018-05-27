
/*****************************************************************************/
/******************************** CONNEXION **********************************/
/*****************************************************************************/

//IHM & AJAX REQUEST FOR CONNEXION
function display_connexionIHM()
{
    swal.mixin({
    input: 'text',
    confirmButtonText: 'Next &rarr;',
    showCancelButton: true,
    progressSteps: ['1', '2']
  }).queue([
    {
      title: 'Vos identifiants',
      text: 'Identifiant'
    },
    'Mot de Passe',
  ]).then((result) => {
    if (result.value) {

      var results = result.value

      //Vérification des identifiant entrées
      if(
        results[0] == undefined || results[1] == undefined ||
        results[0] == "" || results[1] == ""
        )
      {
        swal({
            type: 'error',
            title: 'Erreur Syntax',
            text: 'La Syntax des identifiants n\'est pas valide.'
          })
      }

      else
      {
        //AJAX REQUEST
        $.ajax({
           url : "traitement.php",
           type : 'POST',
           data : 'fonction=testConnexion&pseudo='+results[0]+"&pass="+results[1],
           dataType : "text",
           success  : function(data){
             console.log(data)
             parseDataConnexion(data)
           },
           error : function(resultat, statut, erreur)
           {
             console.log("[ERROR] -> Fail to testConnexion()");
             console.log(erreur)
             swal({
                 type: 'error',
                 title: 'Erreur de Connexion',
                 text: erreur
               })

           }
         });//END AJAX
      }

    }
  })
}

//CONTROLE RESPONSE AJAX
function parseDataConnexion(data)
{
  if(data=="SUCCESS")
      document.location.href="index.php"

  else if(data == "FAIL")
  {
    swal({
        type: 'error',
        title: 'Erreur de Connexion',
        html: "Identifiants erronés"
      })
  }

  else
  {
    swal({
        type: 'error',
        title: 'Un problème est survenue',
        html: data
      })
  }
}

/*****************************************************************************/
/********************************** LOG OUT **********************************/
/*****************************************************************************/

//IHM & AJAX REQUEST FOR LOGOUT
function logOut()
{
    swal({
    title: 'Log Out',
    text: "Voulez-vous vous déconnecter ?",
    type: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Déconnexion',
    cancelButtonText : 'Annuler'
  }).then((result) => {

    if (result.value) {
      //AJAX
      $.ajax({
         url : "traitement.php",
         type : 'POST',
         data : 'fonction=logOut',
         dataType : "text",
         success  : function(data){
           console.log(data)
           parseDataLogOut(data)
         },
         error : function(resultat, statut, erreur)
         {
           console.log("[ERROR] -> Fail to logOut()");
           console.log(erreur)
           swal({
               type: 'error',
               title: 'Erreur Serveur',
               text: erreur
             })

         }
        });
    }
  })
}

//CONTROLE RESPONSE AJAX
function parseDataLogOut(data)
{

  if(data=="SUCCESS")
      document.location.href="index.php"

  else
  {
    swal({
        type: 'error',
        title: 'Un problème est survenue',
        html: data
      })
  }
}

/******************************************************************************/
/***************************** INSCRIPTION  **********************************/
/*****************************************************************************/

//IHM
async function display_inscriptionIHM()
{
  const {value: pseudo,value :mail,value : pass, value : passC, value : nom, value : prenom} = await swal({
    title: 'Inscription',
    html:
      '<input id="pseudo" class="swal2-input" placeholder="Votre Pseudo">' +
      '<input id="mail" class="swal2-input" placeholder="Votre m@il" type="mail">'  +
      '<input id="pass" class="swal2-input" placeholder="Mot de passe" type="password">' +
      '<input id="passC" class="swal2-input" placeholder="Confirmation" type="password">' +
      '<input id="nom" class="swal2-input" placeholder="Votre Nom">' +
      '<input id="prenom" class="swal2-input" placeholder="Votre Prénom">'
      ,
    focusConfirm: false,
    preConfirm: (pseudo,mail,pass,passC,nom,prenom) => inscriptionTenta($('#pseudo').val(),$('#mail').val(),$('#pass').val(),$('#passC').val(),$('#nom').val(),$('#prenom').val())
  })
}


//AJAX REQUEST & CONTROLS
async function inscriptionTenta(pseudo,mail,pass,passC,nom,prenom)
{

  if(pseudo != "" && pseudo !=undefined &&
    mail != "" && mail !=undefined &&
    pass != "" && pass !=undefined &&
    passC != "" && passC !=undefined &&
    nom != "" && nom !=undefined &&
    prenom != "" && prenom !=undefined
  )
  {
    if(pass != passC)
    {
      swal({type: 'error',title: 'Les deux Mot de Passe sont différents.',timer:5000})
      return false;
    }

    else if(!validateEmail(mail))
    {
      swal({type: 'error',title: 'Email invalide.',timer:5000})
      return false;
    }


    $.ajax({
       url : "traitement.php",
       type : 'POST',
       data : 'fonction=inscription&pseudo='+pseudo+"&mail="+mail+"&pass="+pass+'&passC='+passC+"&nom="+nom+"&prenom="+prenom,
       success : function(code_html, statut){

         if(code_html == "DONE")
         {
             swal({type: 'success',title: 'Inscription validée.',timer:3000})
             document.location.href="index.php";
         }

        else
         swal({type: 'error', title: 'Un problème est survenue.',html:code_html});
       },
       error : function(resultat, statut, erreur){swal({type: 'error',title: 'Un problème est survenue.',html:erreur})}
      });
    return true;
  }

  else {
    swal({type: 'error',title: 'Syntaxe Incorrect',timer:5000})
    return false;
  }
}


/******************************************************************************/
/******************************* OTHERS  **************************************/
/******************************************************************************/
function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}
