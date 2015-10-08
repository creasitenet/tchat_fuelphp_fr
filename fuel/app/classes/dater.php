<?php 

class Dater {
	
	public function __construct(){		
		//log_message('debug', "Classe Dater initialisée"); 
	}

	// Temps écoulé
	// Temps écoulé entre 2 timestamp
    static function elapsedtime($timestamp1,$timestamp2=0) {
        if ($timestamp2 == 0) {
        	$timestamp2 = time();
        }
        
        $a = date("Y",$timestamp1);
        $m = date("n",$timestamp1);
        $j = date("j",$timestamp1);
        
        $an = date("Y",$timestamp2) - $a;
        $mois = date("n",$timestamp2) - $m;
        $jour = date("j",$timestamp2) - $j;
        
        // Durée en année, mois, jours.
        if ($jour<0) {
	        $d2=mktime(0,0,0,date("n")-1,date("j"),date("Y"));
	        $diff=Dater::date_nbdays4month(date("n",$d2),date("Y",$d2));
	        $jour+=$diff;
	        $mois--;
        }
        
        if ($mois<0) {
	        $mois+=12;
	        $an--;
        }
        $txt = '';
        
        if ($an == 1) {
        // Depuis 1 an
        if (($mois >= 6) AND ($mois <= 7)) {
        	$txt.= '1 an';
        } elseif ($mois >= 11) {
        	$txt.= '2 ans';
        } elseif ($mois >= 2) {
        	$txt.= '1 an';
        } else {
        	$txt.= '1 an';
        }
        } elseif ($an > 1) {
        // Depuis plusieurs années
        if ($mois < 5) {
        	$txt.= $an.' ans';
        } elseif ($mois <= 8) {
        	$txt.= $an.' ans';
        } else {
        	$txt.= ($an+1).' ans';
        }
        } elseif ($mois >= 1) {
        // Depuis plusieurs mois
        if ($jour < 16) {
        	$txt.= $mois.' mois';
        } else if (($jour >= 14) AND ($jour <= 16)) {
        	$txt.= $mois.' mois';
        } else {
        	$txt.= ($mois+1).' mois';
        }
        } elseif ($jour >= 1) {
	        if ($jour == 1) {
	       		$txt.= '24 heures';
	        } elseif ($jour >=29) {
	       		$txt.= '1 mois';
	        } elseif (($jour >=6) AND ($jour <= 8)) {
	        	$txt.= '1 semaine';
	        } elseif ($jour >= 16) {
	        	$txt.= ceil($jour/7).' semaines';
	        } else {
	        	$txt.= $jour.' jours';
	        }
        } else {
        	$ecart = ceil(date('U',$timestamp2)-date('U',$timestamp1));
	        if (($ecart <= 65) AND ($ecart >= 58)) {
	        	$txt ='1 minute';
	        } elseif ($ecart <= 60) {
	        	$txt = $ecart.' sec';
	        } elseif (($ecart >= (58 * 60)) AND ($ecart <= (62 * 60))) {
	        	$txt = '1 heure';
	        } elseif ($ecart <= (60 * 60)) {
	        	$txt = ceil($ecart/60).' minutes';
	        } elseif (($ecart >= (73 * 60)) AND ($ecart <= (77 * 60))) {
	        	$txt = '1 heure 15';
	        } elseif (($ecart >= (88 * 60)) AND ($ecart <= (92 * 60))) {
	        	$txt = '1 heure 30';
	        } elseif ($ecart < (120 * 60)) {
	        	$txt = '1 heure '.ceil(($ecart-(60*60))/60);
	        } else {
	        	$txt = ceil($ecart/(60*60)).' heures';
	        }
        }
        return $txt;
    }

    static function date_nbdays4month($month,$year) {
        if ($month==2) {
	        if($year%4) return 28;
	        elseif($year%100) return 29;
	        elseif($year%1000) return 28;
	        else return 29;
        } else if (($month==4)||($month==6)||($month==9)||($month==11)) {
        	return 30;
        }
        return 31;
    }
		
}