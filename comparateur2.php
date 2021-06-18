<?php 
    require('./config/dbconnexion.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/comparateur.css" />
</head>
<body>
    <div class="formulaireFiltres">
        <form action="" method="GET" class="formulaireEmail"> 
            <div>
                <label for="type"> Vous recherchez une banque pour : </label>
                <select name="type">
                    <option value="">--Selectionnez une option</option>
                    <option value="Investir">Investir</option>
                    <option value="Epargner">Epargner</option>
                </select>
                
            </div>

            <div>
                <label for="theme"> Sélectionnez les valeurs qui vous sont chères : </label>
                <select name="theme">
                    <option value="">--Selectionnez une option</option>
                    <option value="Engagement environnemental">Engagement environnemental</option>
                    <option value="Engagement social">Engagement social</option>
                </select>
            </div>

            <div>
                <label for="montant"> Saisissez un montant (€) : </label>
                <input name="montant" type="number" />
            </div>


            <button>RECHERCHER</button>
        </form>
    </div>

    <?php if(isset($_GET['type']) || isset($_GET['theme']) || isset($_GET['montant'])) { ?>
        <div class="conteneurBanques">
            <?php

                    $type = $_GET['type'];
                    $montant = $_GET['montant'];
                    $theme = $_GET['theme'];

                    echo $type;

                    $requete = 'SELECT * FROM banques'
                            . ($type || $montant || $theme ? ' WHERE ' : '')
                            . ($type ? "type = '" . $type . "'"  . ($montant || $theme ? ' AND ' : '') : '')
                            . ($montant ? "placementMin <= " . $montant . ' && plafond >= ' . $montant . "" . ($theme ? ' AND ' : '') : '')
                            . ($theme ? "theme = '" . $theme . "'" : '')
                            . ';';

                    $req = $bdd->query($requete); // WHERE email = :email ORDER BY datearrivee
                    while($donnees = $req->fetch()) { ?>
                        <div class="blocBanque">
                            <h3 style="padding:0;margin:0;"><?php echo $donnees['nom'] ?></h3>
                            <hr/>
                            <ul>
                                <li><b>Valeurs : </b> <?php echo $donnees['valeurs'] ?> </li>
                                <li><b>Type d'actif : </b> <?php echo $donnees['actif'] ?> </li>
                                <li><b>Plafond : </b> <?php echo $donnees['plafond'] ?> </li>
                                <li><b>Taux brut pour 1 an (%) : </b> <?php echo $donnees['taux'] ?> </li>
                                <li><b>Niveau de risque : </b> <?php echo $donnees['risque'] ?> </li>
                                <li><b>Engagements : </b> <?php echo $donnees['engagements'] ?> </li>

                            </ul>
                        </div>
                        
            <?php } ?>
        </div>
    <?php } ?>
</body>
</html>