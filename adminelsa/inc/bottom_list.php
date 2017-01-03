<?php
/*
 *		COMPOSANT DE NAVIGATION EN BAS D'UNE LISTE (EX: TABLEAU)
 * Contraintes de fonctionnement :
 * Les variables suivantes doivent être initialisées dans la page appelante
 * $nb_pages	= Nombre total de pages
 * $total		= Nombre total d'elts
 * Intégré à un formulaire <form name="list"> qui intègre les éventuels paramètres coutrants
 */
echo "<input type=\"hidden\" name=\"page\" value=\"\">\n";	// Sera initialisé dans la fonction javascript appelée ci dessous
echo "<p align=center> < ";
for ( $i = 1 ; $i<=$nb_pages ; $i ++) {
  echo "<input class=nav type=button value=$i OnClick=\"javascript:List( '$i');\">";
  if ( $i < $nb_pages ) echo ' | ';
}
echo " ><br>Total: <b>$total</b> &nbsp;&nbsp;<i>Page courante: <b>$page</b></i></p>\n";
?>