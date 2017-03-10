<div class="row">
    <div>

        <form class="form-horizontal form-bagel" method="POST" action="index.php#bagelsm?commande=success">
            <div class="col-sm-6">
                <?php
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                    $id = $donnees['id'];
                    $nom = $donnees['nom'];
                    $prix = $donnees['prix'];
                    $src = $donnees['img'];
                    $nblignes = count($donnees) / 2;


                            echo '   
   <div class="col-xs-6">
    <span>' . $donnees['nom'] . ' ' . $donnees['prix'] . ' €</span>
    <div class="flatRoundedCheckbox">
            <input id="flatOneRoundedCheckbox' . $id . '" name="ingredient' . $id . '" type="checkbox" alt="2" class="check" value="' . $id . '" onclick="totalIt()">
            <input type="hidden" class="id" value="' . $prix . '">
            <label for="flatOneRoundedCheckbox' . $id . '"></label>
            <div></div>
    </div>
    </div>';


                } ?>
            </div>
            <div class="col-sm-6">


                <?php if (isset($_SESSION['pseudo'])) {
                    echo '

    <label >Vous commandez en tant que ' . $_SESSION ['prenom'] . ' ' . $_SESSION ['nom'] . ' <a href="déconnexion.php" class="btn btn-default">déconnexion</a></label>
    <input type="hidden" name="nom" value="' . $_SESSION ['prenom'] . '">
    <input type="hidden" name="prenom" value="' . $_SESSION ['nom'] . '">
    <input type="hidden" name="mail" value="' . $_SESSION ['mail'] . '">
    <input type="hidden" name="tel" value="' . $_SESSION ['tel'] . '">
    ';
                } else {

                    echo '
<label>Vous commandez en tant qu\'invité ;) Pour vous connecter, <a href="formulaire_membre.php" class="btn btn-default">connectez-vous</a></label>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" class="form-control" required>
        </div>
        <div class="form-group">
                <label for="mail">Mail</label>
                <input type="text" name="mail" class="form-control" required>
        </div>
        <div class="form-group">
                <label for="tel">Téléphone</label>
                <input type="text" name="tel" class="form-control" value="" required>
        </div>
        ';
                }
                ?>

                <div class="form-group">
                    <input type="hidden" name="idcommande" value="">
                    <button type="submit" class="btn btn-default" name="envoyer">Commander !</button>
                    <label>
                        Total
                        <input value="$0.00" readonly="readonly" type="text" id="total"/>
                    </label>
                </div>

            </div>
        </form>

    </div>


    <script>
        function totalIt() {
            var input = document.getElementsByClassName("check");
            var total = 0;
            for (var i = 0; i < input.length; i++) {
                if (input[i].checked) {
                    var input2 = document.getElementsByClassName("id");
                    total += parseFloat(input2[i].value);
                }
            }
            document.getElementById("total").value = "$" + total.toFixed(2);
        }
    </script>

</div>
