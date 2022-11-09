<?php





session_start();
    if(isset($_POST['valider'])){
        if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
            $pseudo_par_defaut="admin" ;
            $mdp_par_defaut="admin1312";

            $pseudo_saisi=htmlspecialchars($_POST['pseudo']);
            $mdp_saisi=htmlspecialchars($_POST['mdp']); 

            if($pseudo_saisi == $pseudo_par_defaut AND $mdp_saisi == $mdp_par_defaut){
                $_SESSION['mdp'] = $mdp_saisi ;
                header('Location: index.php');

            }else{
                echo "<div class='alert alert-danger' role='alert' style=' font-weight: 700;'>
                Votre mot de passe ou pseudo est incorrect
                </div> " ;
               
            }

        }else{
            echo "<div class='alert alert-danger' role='alert' style=' font-weight: 700;'>
            Veuillez completer tous les champs
          </div> " ;
         
        }
    }

?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOPNET PRODUCTS</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="style.css">

</head>

<body>


    <section class="contactadmin" id="contact">

        <h1 class="heading"> <span>ADMIN </span> LOGIN</h1>

        <div class="row">

            <form action="" method="POST">

                <div class="inputBox">

                    <input type="text" placeholder="USER NAME" name="pseudo">
                </div>



                <div class="inputBox">

                    <input type="password" placeholder="password" name="mdp">
                </div>


                <input type="submit" value="LOGIN" class="btn" name="valider">

            </form>

        </div>

    </section>

</body>

</html>