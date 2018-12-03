<?php
/* ///////////////////////////////////////////////////////////////
  FONCTIONS STRING
  Clair et Net.
  ////////////////////////////////////////////////////////////// */
  
class cnStrings {

    public static function stripString($theString, $charlength) {
        $theString = strip_tags($theString);
        $charlength++;

        if (mb_strlen($theString) > $charlength) {
            $subex = mb_substr($theString, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
            if ($excut < 0) {
                echo mb_substr($subex, 0, $excut);
            } else {
                echo $subex;
            }
            echo '...';
        } else {
            echo $theString;
        }
    }
  
  
  public static function returnstripString($theString, $charlength) {
        $theString = strip_tags($theString);
        $charlength++;

        if (mb_strlen($theString) > $charlength) {
            $subex = mb_substr($theString, 0, $charlength - 5);
            $exwords = explode(' ', $subex);
            $excut = - ( mb_strlen($exwords[count($exwords) - 1]) );
            if ($excut < 0) {
                return mb_substr($subex, 0, $excut) . '...';
            } else {
                return $subex . '...';
            }
          
        } else {
            return $theString;
        }
    }

    // Transformer une chaine avec caract�re interdits en valide
    public static function validstring($chaineNonValide) {
        $chaineNonValide = preg_replace('`\s+`', '', trim($chaineNonValide));
        $chaineNonValide = str_replace("'", "", $chaineNonValide);
        $chaineNonValide = str_replace("/", "-", $chaineNonValide);
        $chaineNonValide = preg_replace('`_+`', '', trim($chaineNonValide));
        $chaineValide = strtr($chaineNonValide, "�����������������������������������������������������", "aaaaaaaaaaaaooooooooooooeeeeeeeecciiiiiiiiuuuuuuuuynn")
        ;
        return (STRTOLOWER($chaineValide));
    }

    public static function is_valid_email($email) {
        return (eregi("^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,4}$", $email));
    }

    // retourne un libell� sans le tiret
    public static function niceLib($term) {
        $value = explode('-', $term, 2);
        $newterm = ( count($value) == 1) ? $value[0] : $value[1];
        return ucwords($newterm);
    }

}