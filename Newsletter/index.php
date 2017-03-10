<?php
session_start();
?>
<?php
/**
 * Created by PhpStorm.
 * User: wilder12
 * Date: 08/03/17
 * Time: 10:09
 */
include 'connect.php';
$bdd = mysqli_connect(SERVER, USER, PASS, DB);
include 'function.php';
$req = "SELECT * FROM ingredient";
$resultat = mysqli_query($bdd, $req);
$resultat2 = mysqli_query($bdd, $req);
$resultat3 = mysqli_query($bdd, $req);

$today = date("Y-m-d H:i:s");

if (isset($_POST['envoyer'])) {
    if (!isset($_SESSION['id'])) {
        foreach ($_POST as $key => $data) {
            $postClean[$key] = mysqli_real_escape_string($bdd, htmlentities(trim($data)));
        }
        $nom = $postClean['nom'];
        $prenom = $postClean['prenom'];
        $mail = $postClean['mail'];
        $tel = $postClean['tel'];

        mysqli_query($bdd, "INSERT INTO client(nom,prenom,mail,tel) VALUES ('$nom','$prenom','$mail','$tel')");

        $lastid = mysqli_insert_id($bdd);
    }
    if (isset($_SESSION['id'])) {
        $lastid = $_SESSION['id'];
    }

    mysqli_query($bdd, "INSERT INTO commande(date,client_id) VALUES ('$today',$lastid)");
    //$reqcount = mysqli_query($bdd, "SELECT COUNT(id) as countIng FROM ingredient");
    //$row = mysqli_fetch_row($reqcount);
    $lastid = mysqli_insert_id($bdd);
    // $row[0]
    while ($donnees = mysqli_fetch_assoc($resultat2)) {
        $idingr = $donnees['id'];
        $qtenews = intval($donnees['qte']) -1;

        if (isset($_POST['ingredient' . $idingr])) {
            $idingredient = $_POST['ingredient' . $idingr];


            mysqli_query($bdd, "INSERT INTO ingredient_has_commande VALUES ($idingredient,$lastid)");
            mysqli_query($bdd, "UPDATE ingredient SET qte = $qtenews WHERE id = $idingredient ");
        }

    }


}
function alerte($num, $text)
{
    $alerte = array(
        1 => '<div class="alert alert-danger" role="alert"><p class="">' . $text . '</p></div>',
        2 => '<div class="alert alert-warning" role="alert"><p class="">' . $text . '</p></div>',
        3 => '<div class="alert alert-success" role="alert"><p class="">' . $text . '</p></div>',
        4 => '<div class="alert alert-warning" role="alert"><p class="">Votre mot de pass est incorrect</p></div>',
        5 => '<div class="alert alert-warning" role="alert"><p class="">Votre pseudo est trop court</p></div>',
        9 => '<div class="alert alert-warning" role="alert"><p class="">Votre pseudo est trop court</p></div><div class="alert alert-warning" role="alert"><p class="">Votre mot de pass est incorrect</p></div>',
        0 => '<div class="alert alert-warning" role="alert"><p class="">Merci de vous connecter pour accéder au BO</p></div>',
        6 => '<div class="alert alert-warning" role="alert"><p class="">Ce pseudo existe déjà</p></div>',
        7 => '<div class="alert alert-success" role="alert"><a href="BO.php">>>>>Félicitation, votre inscription a été enregistré. Direction le BO en cliquant ici<<<< </a></div>',
        10 => '<div class="alert alert-danger" role="alert"><p class="">L\'item a été correctement supprimer</p></div>',
        11 => '<div class="alert alert-success" role="alert"><p class="">L\'item a été correctement mis à jour</p></div>',
        12 => '<div class="alert alert-success" role="alert"><p class="">Vous avez correctement ajouté un item à votre menu</p></div>');
    return $alerte[$num];
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta description="" />
		 <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		 <link rel="stylesheet" type="text/css" href="css/LCV.css">
		 <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">
		 <meta charset="utf-8">
	</head>

	<body>
		<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.8&appId=520165188123903";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, 'script', 'facebook-jssdk'));
		</script>

<!-- Caméléon en balade -->

		<div class="cameleon cam1">
			<img class="img-responsive" src="Images/icon.png">
		</div>
		<div class="cameleon cam2">
			<img class="img-responsive" src="Images/icon.png">
		</div>
		<div class="cameleon cam3">
			<img class="img-responsive" src="Images/icon.png">
		</div>
		<div class="cameleon cam4">
			<img class="img-responsive" src="Images/icon.png">
		</div>
		<div class="cameleon cam5">
			<img class="img-responsive" src="Images/icon.png">
		</div>

<!-- header -->

		<div class="container ctn">
			<header class="container-fluid">
				<nav class="navbar navbar-inverse">
					<div class="container-fluid">
						<div>
							<img class="img-responsive logo_header" src="Images/logo_medaillon.png">
						</div>

		    <!-- Brand and toggle get grouped for better mobile display -->

		    			<div class="navbar-header" id="top">
			      			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
			        			<span class="sr-only">Toggle navigation</span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
						        <span class="icon-bar"></span>
			      			</button>
		      				<!-- <a class="navbar-brand" href="#">Brand</a> -->
		    			</div>

		    <!-- Collect the nav links, forms, and other content for toggling -->

					    <div class="collapse navbar-collapse pull-right" id="bs-example-navbar-collapse-1">
					      <ul class="nav navbar-nav">
					        <li><a class="js-scrollTo" href="#concept">Notre Concept</a></li>
					        <li><a class="js-scrollTo" href="#formules">Nos Formules</a></li>
					        <li><a class="js-scrollTo" href="#bagels">Nos Bagels</a></li>
					        <li><a class="js-scrollTo" href="#bagelsm">Sur-Mesure</a></li>
					        <li><a class="js-scrollTo" href="#menus">Nos Menus</a></li>
					        <li><a class="js-scrollTo" href="#ou">Où nous trouver</a></li>
					      </ul>
					    </div><!-- /.navbar-collapse -->
		  			</div><!-- /.container-fluid -->
				</nav>

				<div class="row">
					<div class="col-xs-12 ">
						<div class="fond-header">
							<h1>LE CAMELEON VOYAGEUR</h1>
							<h2 class="titre2photo">American & Korean Food Truck<br>
							Région Orléanaise</h2>
							<h3 class="telheader">06 69 15 43 08</h3>
							<div class="telheaderxs">
								<button type="button" class="visible-xs-block btn btn-default btn-circle">
									<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
								</button>
								<span><a href="tel:+0669154308"> </a></span>
							</div>
						 		<img class="img-responsive" src="Images/Bagel_Header.jpg"/>
						</div>
					</div>
				</div>
			</header>

		<!-- End header -->

		<!-- Formules -->

			<div id="formules" class="separate-container">
				<div class="separate"></div>
				<span class="titres-sections">NOS FORMULES</span>
			</div>
			<section class="container-fluid">

			<!-- Visible pour tablette et + -->

				<div class="row hidden-xs">
					<div class="col-md-3 col-sm-6 formbord1">
						<div class="content formule ">
							<h2>Formule <br />
							La faim de la route <br /></h2>
				     		<p>Bagel ou Kimpab + boisson<br /></p>
					     		<div class="prix-formule">
					     			<p><big>7,60€</big></p>
								</div>
						</div>		
					</div>	
					<div class="col-md-3 col-sm-6 formbord">
						<div class="content formule ">
							<h2>Formule <br />
							La faim du voyage <br /></h2>
					     	<p>Bagel + petite salade ou chips + boisson<br /></p>
					     		<div class="prix-formule">
					     			<p><big> 8,60€</big></p>
					     		</div>
					     </div>
					</div>
					<div class="col-md-3 col-sm-6 formbord1">
						<div class="content formule ">
							<h2>Formule <br />
							Une faim de loup <br /></h2>
				     		<p>Bagel + dessert + boisson<br /></p>
				     			<div class="prix-formule">
				     				<p><big> 10€</big></p>
						    	</div>
						</div>    	
					</div>
					<div class="col-md-3 col-sm-6 formbordlast">
						<div class="content formule ">	
							<h2>Formule <br />
							La faim du monde <br /></h2>
				     		<p>Bagel + petite salade ou chips + dessert + boisson<br /></p>
					     		<div class="prix-formule">
						     		<p><big> 11,50€</big></p>
						     	</div>		
				     	</div>
				    </div> 
				</div>

				<!-- Visible pour smartphone -->

				<div class="visible-xs-block">

		  			<!-- Wrapper for slides -->

		  			<div id="carousel-example-generic1" class="carousel slide" data-ride="carousel">

					  <!-- Indicators -->

						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic1" data-slide-to="0" class="active"></li>
						    <li data-target="#carousel-example-generic1" data-slide-to="1"></li>
						    <li data-target="#carousel-example-generic1" data-slide-to="2"></li>
						    <li data-target="#carousel-example-generic1" data-slide-to="3"></li>
						</ol>

			  			<div class="carousel-inner" role="listbox">

			   				<div class="item active">
			     				<div class="carousel-content formulecarousel">
			     					<h2>Formule <br />
									La faim de la route <br /></h2>
			     					<p>Bagel ou Kimpab + boisson<br />
			     					<big><span class="prixformule">7,60€</span></big></p>
			      				</div>
			    			</div>
			    			<div class="item">
			      				<div class="carousel-content formulecarousel">
			     					<h2>Formule <br />
									La faim du voyage <br /></h2>
				     				<p>Bagel + petite salade ou chips + boisson<br />
				     				<big> 8,60€</big></p>
				   				</div>
				   			</div>	
				    		<div class="item">
			      				<div class="carousel-content formulecarousel">
			     					<h2>Formule <br />
									Une faim de loup <br /></h2>
			     					<p>Bagel + dessert + boisson<br />
			     					<big> 10€</big></p>
				   				</div>
				   			</div>
				   			<div class="item">
			      				<div class="carousel-content formulecarousel">
			      					<h2>Formule <br />
									La faim du monde <br /></h2>
			     					<p>Bagel + petite salade ou chips + dessert + boisson<br />
			     					<big> 11,50€</big></p>
				      			</div>	
				   			</div>
				 		</div>

			  			<!-- Controls -->

			  			<a class="left carousel-control" href="#carousel-example-generic1" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic1" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</section>

		<!-- End Formules -->

		<!-- Bagels -->

			<div id="bagels" class="separate-container">
				<div class="separate"></div>
				<span class="titres-sections">BAGELS 6.60€</span>
			</div>
				
			<section  class="bg-green">

			<!-- Visible pour tablette et + -->

				<div class="row hidden-xs">
					<div class="col-sm-4 col-hidden-xs">
						<img class="img-responsive" src="Images/Bagel1.jpg" alt="">
					</div>
					<div class="col-sm-4 hidden-xs">
						<img class="img-responsive" src="Images/Bagel2.jpg" alt="">
					</div>
					<div class="col-sm-4 hidden-xs">
						<img class="img-responsive" src="Images/Bagel3.jpg" alt="">
					</div>
					<div class="col-sm-4 hidden-xs">
						<img class="img-responsive" src="Images/Bagel4.jpg" alt="">
					</div>
					<div class="col-sm-4 hidden-xs">
						<img class="img-responsive" src="Images/Bagel5.jpg" alt="">
					</div>
					<div class="col-sm-4 hidden-xs">
						<img class="img-responsive" src="Images/Bagel6.jpg" alt="">
					</div>
				</div>

				<!-- Visible pour smartphone -->

				<div class="visible-xs-block">
					<div id="carousel-example-generic" class="carousel slide bg-green" data-ride="carousel">

					  <!-- Indicators -->

						<ol class="carousel-indicators">
							<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="3"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="4"></li>
						    <li data-target="#carousel-example-generic" data-slide-to="5"></li>
						</ol>

					  <!-- Wrapper for slides -->

						<div class="carousel-inner carousel-bagel" role="listbox">
						    <div class="item active ">
						    	<img class="img-responsive img-center" src="Images/Bagel1.jpg" alt="">
						    	<div class="carousel-caption">
						       
						    	</div>
						    </div>
						    <div class="item">
						    	<img class="img-responsive img-center" src="Images/Bagel2.jpg" alt="">
						    	<div class="carousel-caption">
					
						    	</div>
						    </div>
						    <div class="item">
						    	<img class="img-responsive img-center" src="Images/Bagel3.jpg" alt="">
						    	<div class="carousel-caption">
						       
						    	</div>
						    </div>
						    <div class="item">
						    	<img class="img-responsive img-center" src="Images/Bagel4.jpg" alt="">
						    	<div class="carousel-caption">
					
						    	</div>
						    </div>
						    <div class="item">
						    	<img class="img-responsive img-center" src="Images/Bagel5.jpg" alt="">
						    	<div class="carousel-caption">
					
						    	</div>
						    </div>
						    <div class="item">
						    	<img class="img-responsive img-center" src="Images/Bagel6.jpg" alt="">
						    	<div class="carousel-caption">
					
						    	</div>
					    	</div>
					   
						</div>

						  <!-- Controls -->

						<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
							<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
						    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						    <span class="sr-only">Next</span>
						</a>
					</div>
				</div>
			</section>

		<!-- End Bagels -->
            <div id="bagelsm" class="separate-container">
                <div class="separate"></div>
                <span class="titres-sections">BAGEL SUR MESURE</span>
            </div>
            <section class="container-fluid text-center">
                <button class="btn btn-primary " type="button" data-toggle="collapse" data-target="#collapseSurMesure" aria-expanded="false" aria-controls="collapseSurMesure">
                    Je commande mon bagel sur-mesure
                </button>
                <div class="collapse" id="collapseSurMesure">
                    <div class="well">

                        <?php include 'formulaire.php';?>
                    </div>
                </div>

            </section>

		<!-- Menu -->

			<div id="menus" class="separate-container">
				<div class="separate"></div>
				<span class="titres-sections">MENU</span>
			</div>

			<section class="container-fluid">
				<div class="row">
					<div class="col-md-6 col-xs-12 carte">
						<h2> Rolls, salades & Co</h2>
						<div class="container-fluid">			
							<div class="row">
								<div class="col-xs-9 carte">
								  	<p>Chicken Rolls <small>(poulet teriyaki, avocat, concombre)</small></p>
								</div>
								  	<div class="col-xs-3 prix"><p>4,50€</p></div>  	
								<div class="col-xs-9 carte">
								  	<p>Thon thon Rolls <small>(thonade, avocat, concombre)</small></p>
								</div>			
								  	<div class="col-xs-3 prix"><p>5,00€</p></div>
								<div class="col-xs-9 carte">
								  	<p>Rock'n'rolls <small>(saumon, avocat, concombre)</small></p>
								</div>
								  	<div class="col-xs-3 prix"><p>6,60€</p></div>  	
								<div class="col-xs-9 carte">
									<p>Kimbap <small>(thonade, carotte, concombre, oeuf, radis)</small></p>
								</div>
									<div class="col-xs-3 prix"><p>2,50€</p></div>  	
								<div class="col-xs-9 carte">
									<p>Mandu <small>(ravioli coréen)</small> X6</p>
								</div>
									<div class="col-xs-3 prix"><p>2,00€</p></div>  	
								<div class="col-xs-9 carte">
									<p>Petite salade <small>(coleslaw, grecque)</small><span class="glyphicon glyphicon-leaf"></span></p>
								</div>
										<div class="col-xs-3 prix"><p>2,00€</p></div>  	
								<div class="col-xs-9 carte">
									<p>Grande salade <small>(coleslaw, grecque)</small><span class="glyphicon glyphicon-leaf"></span></p>
								</div>
									<div class="col-xs-3 prix"><p>4,00€</p></div>  	
								<div class="col-xs-9 carte">
									<p>Chips</p>
								</div>	
									<div class="col-xs-3 prix"><p>1,50€</p></div>
							</div>		
						</div>
					</div>
					<div class="col-md-6 col-xs-12 carte">				
						<h2>Desserts</h2>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-9 carte">
									<p>Cheesecake maison</p>
								</div>
								<div class="col-xs-3 prix"><p>3,50€</p>
								</div>
								<div class="col-xs-9 carte">
									<p>Muffin (blueberry, pépites de chocolat)</p>
								</div>
								<div class="col-xs-3 prix"><p>2,70€</p>
								</div>
								<div class="col-xs-9 carte">
									<p>Cookies (pépites de chocolat, tout chocolat)</p>	
								</div>
								<div class="col-xs-3 prix"><p>2,50€</p>
								</div>
							</div>
							</div>
						<h2>Boissons</h2>
						<div class="container-fluid">
							<div class="row">
								<div class="col-xs-9 carte">
									<p>Sodas 33 cl, eau 50 cl</p>
									</div>
								<div class="col-xs-3 prix"><p>1,50€</p>
								</div>
								<div class="col-xs-9 carte">	
									<p>Expresso</p>
								</div>
								<div class="col-xs-3 prix"><p>1,50€</p>
								</div>
							</div>
						</div>	
			  		</div>
			  	</div>

			  	<br /><p><span class="glyphicon glyphicon-leaf"></span><small>Plat végétarien</small></p>

			</section>

		<!-- End Menu -->

		<!-- Map -->

			<div id="ou" class="separate-container">
				<div class="separate"></div>
				<span class="titres-sections">OU NOUS TROUVER ?</span>
			</div>

			<section>
				<div>
					<iframe width="100%" height="300px" frameBorder="0" src="http://umap.openstreetmap.fr/fr/map/carte-sans-nom_130257?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=true&onLoadPanel=undefined&captionBar=false"></iframe><p><a href="http://umap.openstreetmap.fr/fr/map/carte-sans-nom_130257">Voir en plein écran</a></p>
				</div>
			</section>

		<!-- End Map -->

		<!--Qui sommes nous? -->

			<div id="concept" class="separate-container">
				<div class="separate"></div>
				<span class="titres-sections">QUI SOMMES-NOUS ?</span>
			</div>

			<section class="container-fluid">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-xs-12  concept">
						<p class="text-concept">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
						</p>
					</div>
					<div class="col-lg-6 col-md-6 col-xs-12 ">
						<img class="imgcouple" src="Images/couple-mini.jpeg">
					</div>
				</div>
			</section>

		<!-- End Qui sommes nous? -->

		<!-- Image -->

			<div id="concept" class="separate-container">
				<div class="separate"></div>
			</div>	

			<section>
				<div class="container-fluid">
					<div class="row insta">
						<a href="https://www.instagram.com/lecameleonvoyageur2197/" target="_blank">
						<div class="col-sm-2 col-xs-4">
							<img class="img-responsive" src="Images/insta1.jpg" alt="">
						</div>
						<div class="col-sm-2 col-xs-4">
							<img class="img-responsive" src="Images/insta2.jpg" alt="">
						</div>			
						<div class="col-sm-2 col-xs-4">
							<img class="img-responsive" src="Images/insta3.jpg" alt="">			
						</div>						
						<div class="col-sm-2 hidden-xs">
							<img class="img-responsive" src="Images/insta4.jpg" alt="">
						</div>						
						<div class="col-sm-2 hidden-xs">
							<img class="img-responsive" src="Images/insta5.jpg" alt="">
						</div>
						<div class="col-sm-2 hidden-xs">
							<img class="img-responsive" src="Images/insta6.jpg" alt="">
						</div>
					</div>
				</div>
			</section>

		<!-- End Image -->

		<!-- menu fixed right -->

		<!-- Start vertical navigation -->

			<div id="op-verticalnav" class="hidden-xs">
				<ul class="op-sectionlist">
					<li class="op-v-item">
						<a class="op-v-link js-scrollTo" href="#formules">
							<span class="v-marker"></span>
							<span class="op-v-itemdesc">
								<span class="op-v-itembg">Nos Formules</span>
							</span>
						</a>
					</li>
					<li class="op-v-item">
						<a class="op-v-link js-scrollTo" href="#bagels">
							<span class="v-marker"></span>
							<span class="op-v-itemdesc">
								<span class="op-v-itembg">Nos bagels</span>
							</span>
						</a>
					</li>
					<li class="op-v-item">
						<a class="op-v-link js-scrollTo" href="#menus">
							<span class="v-marker"></span>
							<span class="op-v-itemdesc">
								<span class="op-v-itembg">Notre menu</span>
							</span>
						</a>
					</li>
					<li class="op-v-item">
						<a class="op-v-link js-scrollTo" href="#ou">
							<span class="v-marker"></span>
							<span class="op-v-itemdesc">
								<span class="op-v-itembg">Où nous trouver ?</span>
							</span>
						</a>
					</li>
					<li class="op-v-item">
						<a class="op-v-link js-scrollTo" href="#concept">
							<span class="v-marker"></span>
							<span class="op-v-itemdesc">
								<span class="op-v-itembg">Notre Concept</span>
							</span>
						</a>
					</li>
				</ul>
			</div>

		<!-- end vertical navigation -->

		<!-- End menu fixed right -->

        <!-- Formulaire Experience -->
            <form action="ciblenp.php" method="post">
                <p>

                <h3>PARTAGEZ VOTRE EXPERIENCE AVEC LE CAMELEON VOYAGEUR</h3>
                <br />
                <div class="form-group">
                    <label>Pseudo</label>
                    <input type="text" class="form-control" name="pseudo" placeholder="Indiquez votre Pseudo"/><br />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Votre adresse email"/><br />
                </div>
                <div class="form-group">
                    <label for="comment"> Commentaires</label>
                    <textarea class="form-control" rows="3" name="comment" id="comment"></textarea>
                </div>
                <br />
                <h3>Quelle note donneriez vous à votre experience avec Le Caméléon Voyageur:<h3></h3><br />
                <div>
                    <input type="radio" name="note" value="0" id="0" /> <label for="0">0 = Euhhh y a t'il vraiment un cuisinier ? ... immangeable !!!</label><br />
                </div>
                <div>
                    <input type="radio" name="note" value="1" id="1" /> <label for="1">1 = Alors ... j'ai mangé, mais pas deux fois !!</label><br />
                </div>
                <div>
                    <input type="radio" name="note" value="2" id="2" /> <label for="2">2 = Mouaiiii ... on a vu mieux !</label><br />
                </div>
                <div>
                    <input type="radio" name="note" value="3" id="3" /> <label for="3">3 = C'était bon ... </label><br />
                </div>
                <div>
                    <input type="radio" name="note" value="4" id="4" /> <label for="4">4 = Je me suis régalé ...</label><br />
                </div>
                <div>
                    <input type="radio" name="note" value="5" id="5" /> <label for="5">5 = Ce fût la meilleur expérience culinaire de ma vie ....</label><br />
                </div>
                <div>
                    <input type="submit" value="Partager" />
                </div>
                </p>
            </form>

            <?php
            include 'connectnp.php';
            $bddnp=mysqli_connect(SERVER,USER,PASS,DB);

            $resultatnp = mysqli_query($bddnp, 'SELECT * FROM commentaires WHERE note IS NOT NULL AND note <> "" AND valid_admin=1');

            while($donneesnp = mysqli_fetch_assoc($resultatnp))
            {
                echo $donneesnp['pseudo'].' '.$donneesnp['comment'].' '.$donneesnp['note'];
            }
            ?>
        <!-- End Formulaire Experience -->

		<!-- Footer -->

			<footer>
				<div class="row">
					<div class="col-sm-2">
						<img class="logo img-responsive" id="footer" src="Images/logo_medaillon.png">
					</div>
					<div class="col-sm-4">
						<div class="info-footer">
							<h3>LE CAMELEON VOYAGEUR</h3>
							<div>
								<button type="button" class="btn btn-default btn-circle">
									<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
								</button>
								<span> lecamelonvoyageur@gmail.com </span>
							</div>
							<div>
								<button type="button" class="btn btn-default btn-circle">
									<i class="fa fa-facebook" aria-hidden="true"></i>
								</button>
								<span> @lecamelonvoyageur </span>
							</div>
							<div>
								<button type="button" class="btn btn-default btn-circle">
									<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
								</button>
								<span><a href="tel:+0669154308">0669154308 </a></span>
							</div>
						</div>
						<div class="contact">
							
							<h2>FOOD TRUCK TRAITEUR TOUS EVENEMENTS</h2>
						</div>


                        <!-- Formulaire Newsletter -->

                        <div class="newsletter">
                            <form class="form-inline" method="POST" action="index.php">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" value="" id="nom" name="nom">
                                </div><br />
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" value="" id="prenom" name="prenom">
                                </div><br />
                                <div class="form-group">
                                    <label for="date_naissance">Né(e) le :</label>
                                    <input type="date" class="form-control" value="" id="date_naissance" name="date_naissance"/>
                                </div><br />
                                <div class="form-group">
                                    <label for="exampleInputEmail2">Email</label>
                                    <input type="email" class="form-control" value="" id="email" name="email">
                                </div><br />
                                <input type="submit" name="btnSubmit" value="Je m'abonne à la newsletter" class="btn btn-default"> </input>
                            </form>
                        </div>
                        <?php

                        include 'connectsp.php';
                        include 'header.php';
                        $bdd = mysqli_connect(SERVER, USER, PASS, DB);
                        if (isset($_POST['btnSubmit'])) {
                            $nom = $_POST['nom'];
                            $prenom = $_POST['prenom'];
                            $date_naissance = $_POST['date_naissance'];
                            $email = $_POST['email'];

                            $req = "INSERT INTO abonnes (nom, prenom, date_naissance, email) VALUES ('$nom', '$prenom', '$date_naissance', '$email')";
                            if(!mysqli_query($bdd, $req)) {
                                echo mysqli_error($bdd);
                            }
                        }
                        ?>
                        <!-- Fin Formulaire Newsletter -->


                    </div>
					<div class="col-sm-6 info-footer">
						<h3>HORAIRES ET LIEU</h3>
						<div>
							<ul class="list-group">
							  <li class="list-group-item">Lundi<span class="pull-right">Lab'o - de 11H30 à 13H30</span></li>
							  <li class="list-group-item">Mardi<span class="pull-right">Lab'o - de 11H30 à 13H30</span></li>
							  <li class="list-group-item">Mercredi<span class="pull-right">Polytech - de 11H30 à 13H30</span></li>
							  <li class="list-group-item">Jeudi<span class="pull-right">Polytech - de 11H30 à 13H30</span></li>
							  <li class="list-group-item">Vendredi<span class="pull-right">ZAC des Aulnay - de 11H30 à 13H30</span></li>
							  <li class="list-group-item">Samedi<span class="pull-right">Fermé</span></li>
							  <li class="list-group-item">Dimanche<span class="pull-right">Fermé</span></li>
							</ul>
						</div>
						<div id="fb-root">
						</div>
						<div class="fb-like" data-href="https://www.facebook.com/lecameleonvoyageur/" data-width="200px" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true">
						</div>

					</div>
					<div class="text-center col-xs-12 cgu">

		<!-- Modal pour les Mentions Légales -->

							<a class="boutons-bas-footer" href="#" data-toggle="modal" data-target="#modalMentions">Mentions Légales     |     </a>
							<div class="modal fade" id="modalMentions" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Mentions Légales</h4>
							      </div>
							      <div class="modal-body">
							        <p>
							        	"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
										Section 1.10.32 du "De Finibus Bonorum et Malorum" de Ciceron (45 av. J.-C.)

										"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"
										Traduction de H. Rackham (1914)

										"But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete account of the system, and expound the actual teachings of the great explorer of the truth, the master-builder of human happiness. No one rejects, dislikes, or avoids pleasure itself, because it is pleasure, but because those who do not know how to pursue pleasure rationally encounter consequences that are extremely painful. Nor again is there anyone who loves or pursues or desires to obtain pain of itself, because it is pain, but because occasionally circumstances occur in which toil and pain can procure him some great pleasure. To take a trivial example, which of us ever undertakes laborious physical exercise, except to obtain some advantage from it? But who has any right to find fault with a man who chooses to enjoy a pleasure that has no annoying consequences, or one who avoids a pain that produces no resultant pleasure?"
										Section 1.10.33 du "De Finibus Bonorum et Malorum" de Ciceron (45 av. J.-C.)

										"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat."
										Traduction de H. Rackham (1914)

										"On the other hand, we denounce with righteous indignation and dislike men who are so beguiled and demoralized by the charms of pleasure of the moment, so blinded by desire, that they cannot foresee the pain and trouble that are bound to ensue; and equal blame belongs to those who fail in their duty through weakness of will, which is the same as saying through shrinking from toil and pain. These cases are perfectly simple and easy to distinguish. In a free hour, when our power of choice is untrammelled and when nothing prevents our being able to do what we like best, every pleasure is to be welcomed and every pain avoided. But in certain circumstances and owing to the claims of duty or the obligations of business it will frequently occur that pleasures have to be repudiated and annoyances accepted. The wise man therefore always holds in these matters to this principle of selection: he rejects pleasures to secure other greater pleasures, or else he endures pains to avoid worse pains."

							        </p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>

		<!-- Modal pour les moyens de paiements -->

							<a class="boutons-bas-footer" href="#" data-toggle="modal" data-target="#modalPaiements">Modes de paiement      |</a>
							<div class="modal fade" id="modalPaiements" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">Modes de paiement</h4>
							      </div>
							      <div class="modal-body">
							        <p>
							        Les différents moyens de paiements
									</p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>

		<!-- Modal pour les Conditions -->

							<a class="boutons-bas-footer" href="#" data-toggle="modal" data-target="#modalCgu">CGU-CGV   </a>
							<div class="modal fade" id="modalCgu" tabindex="-1" role="dialog">
							  <div class="modal-dialog" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        <h4 class="modal-title">CGU-CGV</h4>
							      </div>
							      <div class="modal-body">
							        <p>
							        Les différents moyens de paiements
									</p>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							      </div>
							    </div>
							  </div>
							</div>
					</div>
				</div>
				<
				<a href="#top" class="visible-xs-block js-scrollTo btn btn-lg back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>
			</footer>

<!-- End Footer -->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script>
			$(document).ready(function() {
				$('.js-scrollTo').on('click', function() { // Au clic sur un élément
					var page = $(this).attr('href'); // Page cible
					var speed = 750; // Durée de l'animation (en ms)
					$('html, body').animate( { scrollTop: $(page).offset().top }, speed ); // Go
					return false;
				});
			});
		</script>
	
	</body>

</html>