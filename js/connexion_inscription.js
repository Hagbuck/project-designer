

function display_connexionIHM()
{
    swal.mixin({
    input: 'text',
    confirmButtonText: 'Next &rarr;',
    showCancelButton: true,
    progressSteps: ['1', '2']
  }).queue([
    {
      title: 'Vos identifiant',
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
          });
      }

    }
  })
}


function parseDataConnexion(data)
{

  if(data=="SUCCESS")
  {
      document.location.href="index.php"
  }

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


function parseDataLogOut(data)
{

  if(data=="SUCCESS")
  {
      document.location.href="index.php"
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
