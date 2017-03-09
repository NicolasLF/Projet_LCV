<div class="row">
    <div>
        <div class="col-xs-12">
            <?php
            if (isset($_GET['commande']) && $_GET['commande'] == 'success') {
                echo alerte(3, 'Votre commande a bien été passée !');

            }
            ?>
        </div>

        <form class="form-horizontal form-bagel" method="POST" action="index.php?commande=success">
            <div class="col-sm-6">
                <?php
                while ($donnees = mysqli_fetch_assoc($resultat)) {
                    $id = $donnees['id'];
                    $nom = $donnees['nom'];
                    $prix = $donnees['prix'];
                    $src = $donnees['img'];
                    echo '   
    <div class="checkbox">
        <label for="ingredient">
            <input name="ingredient' . $id . '" type="checkbox" alt="2" class="check" value="' . $id . '" onclick="totalIt()">
            <input type="hidden" class="id" value="' . $prix . '">
            ' . $nom . ' ' . $prix . ' € 
        </label>
    </div>';

                } ?>
            </div>
            <div class="col-sm-6">


                <?php if (isset($_SESSION['pseudo'])) {
                    echo '
        <div>Vous commandez en tant que ' . $_SESSION ['prenom'] . ' ' . $_SESSION ['nom'] . '</div>
    <input type="hidden" name="nom" value="' . $_SESSION ['prenom'] . '">
    <input type="hidden" name="prenom" value="' . $_SESSION ['nom'] . '">
    <input type="hidden" name="mail" value="' . $_SESSION ['mail'] . '">
    <input type="hidden" name="tel" value="' . $_SESSION ['tel'] . '">
    ';
                } else {

                    echo '
        <div>Vous commandez en tant qu\'invité ;)</div>
        <div class="form-group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" class="form-control">
        </div>
        <div class="form-group">
            <label for="prenom">Prenom</label>
            <input type="text" name="prenom" class="form-control">
        </div>
        <div class="form-group">
                <label for="mail">Mail</label>
                <input type="text" name="mail" class="form-control">
        </div>
        <div class="form-group">
                <label for="tel">Téléphone</label>
                <input type="text" name="tel" class="form-control" value="">
        </div>
        ';
                }
                ?>


                <input type="hidden" name="idcommande" value="">
                <input type="submit" name="envoyer">
                <label>
                    Total
                    <input value="$0.00" readonly="readonly" type="text" id="total"/>
                </label>
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
