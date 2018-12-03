<?php
/* ///////////////////////////////////////////////////////////////
  FONCTIONS DATES
  Clair et Net.
  ////////////////////////////////////////////////////////////// */

class cnDates {

/// conversion des dates
    public static function convertDate($str, $type = 'long') {

        /// pour rse si date = 01/01 on ne retourne que l'année
        $checkdate = explode('-', $str);
        if ($checkdate[1] == '01' && $checkdate[2] == '01') {
            return date_i18n('Y', strtotime("$str"));
            exit;
        }

        if ($type == 'month') :
            return date_i18n('F Y', strtotime("$str"));
        elseif ($type == 'court') :
            return date_i18n('j M Y', strtotime("$str"));
        elseif ($type == '/') :
            return date_i18n('d/m/Y', strtotime("$str"));
        else :
            return date_i18n('j F Y', strtotime("$str"));
        endif;
    }

/// récupérer la date du jour
    public static function getTodayDate() {
        $today = date('Y-m-d', strtotime('-6 hours'));
        return $today;
    }

/// retourne l'affichage d'une période pour l'agenda
    public static function getPeriode($date_debut, $date_fin, $sepStart = '', $sepEnd = '') {
        if ($date_debut != '')
            $date_debut = preg_replace("/([0-9]{2})([0-9]{2})-([0-9]{2})-([0-9]{2})/i", "$4/$3/$2", $date_debut);
        if ($date_fin != '')
            $date_fin = preg_replace("/([0-9]{2})([0-9]{2})-([0-9]{2})-([0-9]{2})/i", "$4/$3/$2", $date_fin);
        if (($date_fin == '') && ($date_debut != '')) {
            $periode = 'le ' . $date_debut;
        } else if (($date_fin == $date_debut)) {
            $periode = 'le ' . $date_debut;
        } else if (($date_fin != '') && ($date_debut != '')) {
            $periode =   'Du ' .$date_debut . ' au ' . $date_fin;
        } else {
            $periode = '';
            $sepStart = '';
            $sepEnd = '';
        };
        return $sepStart . $periode . $sepEnd;
    }

}