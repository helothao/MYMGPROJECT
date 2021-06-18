<?php
require('./config/dbconnexion.php')
?>

<!DOCTYPE html>
<html style="font-size: 16px">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="page_type" content="np-template-header-footer-from-plugin" />
    <title>A propos du projet</title>
    <link rel="stylesheet" href="./styles/nicepage.css" media="screen" />
    <link rel="stylesheet" href="./styles/A-propos-du-projet.css" media="screen" />
    <script class="u-script" type="text/javascript" src="./script/jquery-1.9.1.min.js" defer=""></script>
    <script class="u-script" type="text/javascript" src="./script/nicepage.js" defer=""></script>
    <meta name="generator" content="Nicepage 3.17.5, nicepage.com" />
    <link id="u-theme-google-font" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i|Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" />

    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "Organization",
            "name": "",
            "logo": "images/200930789_200446098612759_2343269356248476456_n.png"
        }
    </script>
    <meta property="og:title" content="A propos du projet" />
    <meta property="og:type" content="website" />
    <meta name="theme-color" content="#f15048" />

    <style>
        .pageHeader {
            display: grid;
            place-items:center;
            width: 100%;
            height: 150px;
            background:#4D7847;
            color: #fff;
        }
        .contenuPage {
            padding: 2em;
        }

        .formulaireFiltres {
            display: flex;
            gap: 2.5em;
            flex-direction: column;
        }

        .filtres {
            display: flex;
            justify-content: space-evenly;
        }

        .filtreItem {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            gap: 1em;
        }

        .champFormulaire {
            outline: none;
            padding: .7em;
            border-radius: 8px;
            box-shadow: 6px 6px 5px #448B2B;
            border: 1px solid #448B2B;
        }

        .boutonsAction {
            display: flex;
            justify-content: center;
            gap: 2em;
            margin-left: 50px;
        }

        .bouton {
            padding: 1em;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            background: #448B2B;
            color: #fff;
            transition: .3s ease-in-out all;
        }

        .bouton:hover {
            box-shadow: 9px 9px 20px rgba(0, 0, 0, 0.3);
            color: #fff;
        }


        .grilleBanques {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
            gap: 4em;
        }

        .carteBanque {
            padding: 1em;
            box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background: white;
        }

        .informationsBanque {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1em;
            margin-bottom: 1em;
        }



        .separateur {
            margin: 2em 0;
        }
    </style>
</head>

<body class="u-body">

    <?php require('./composants/navbar.php') ?>

    <div class="pageHeader">
        <h2>TROUVER UNE BANQUE</h2>
    </div>

    <div class="contenuPage">
        <form action="" method="GET" class="formulaireFiltres">
            <div class="filtres">
                <div class="filtreItem">
                    <label for="type"> Vous recherchez une banque pour : </label>
                    <select class="champFormulaire" name="type">
                        <option value="">Sélectionnez une option</option>
                        <option value="Investir" <?php if (isset($_GET['type']) && $_GET['type'] === 'Investir') echo 'selected'; ?>>Investir</option>
                        <option value="Epargner" <?php if (isset($_GET['type']) && $_GET['type'] === 'Epargner') echo 'selected'; ?>>Epargner</option>
                    </select>
                </div>

                <div class="filtreItem">
                    <label for="theme"> Sélectionnez les valeurs qui vous sont chères : </label>
                    <select class="champFormulaire" name="theme">
                        <option value="">--Selectionnez une option</option>
                        <option value="Engagement environnemental" <?php if (isset($_GET['theme']) && $_GET['theme'] === 'Engagement environnemental') echo 'selected'; ?>>Engagement environnemental</option>
                        <option value="Engagement social" <?php if (isset($_GET['theme']) && $_GET['theme'] === 'Engagement social') echo 'selected'; ?>>Engagement social</option>
                    </select>
                </div>

                <div class="filtreItem">
                    <label for="montant"> Saisissez un montant (€) : </label>
                    <input class="champFormulaire" name="montant" type="number" <?php if (isset($_GET['montant'])) echo 'value="' . $_GET['montant'] . '"' ?> />
                </div>
            </div>

            <div class="boutonsAction">
                <button class="bouton">RECHERCHER</button>
                <a class="bouton" href="./index.php">REINITIALISER</a>
            </div>



        </form>

        <hr class="separateur" />

        <div class="grilleBanques">
            <?php

            $type = isset($_GET['type']) ? $_GET['type'] : null;
            $montant = isset($_GET['montant']) ? $_GET['montant'] : null;
            $theme = isset($_GET['theme']) ? $_GET['theme'] : null;

            $requete = 'SELECT * FROM banques'
                . ($type || $montant || $theme ? ' WHERE ' : '')
                . ($type ? "type = '" . $type . "'"  . ($montant || $theme ? ' AND ' : '') : '')
                . ($montant ? "placementMin <= " . $montant . ' && plafond >= ' . $montant . "" . ($theme ? ' AND ' : '') : '')
                . ($theme ? "theme = '" . $theme . "'" : '')
                . ';';

            $req = $bdd->query($requete); // WHERE email = :email ORDER BY datearrivee
            while ($donnees = $req->fetch()) { ?>
                <div class="carteBanque">
                    <h3 style="padding:0;margin:0;"><?php echo $donnees['nom'] ?></h3>
                    <hr />
                    <div class="informationsBanque">
                        <div class="informationItem">
                            <b>Valeurs : </b> <?php echo $donnees['valeurs'] ?> 
                        </div>
                        <div class="informationItem">
                            <b>Type d'actif : </b> <?php echo $donnees['actif'] ?>
                        </div>
                        <div class="informationItem">
                            <b>Plafond : </b> <?php echo $donnees['plafond'] ?>
                        </div>
                        <div class="informationItem">
                            <b>Taux brut pour 1 an (%) : </b> <?php echo $donnees['taux'] ?>
                        </div>
                        <div class="informationItem">
                            <b>Niveau de risque : </b> <?php echo $donnees['risque'] ?>
                        </div>
                    </div>

                    <div class="informationItem" style="grid-column: auto / auto;">
                        <b>Engagements : </b> <span style="text-align:justify !important;"><?php echo $donnees['engagements'] ?></span>
                    </div>
                </div>

            <?php } ?>
        </div>

    </div>
    <?php require('./composants/footer.php') ?>
</body>

</html>