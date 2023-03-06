<?php 
class Tableau {
    // génère un <table></table> permettant d'afficher des objets
    private $thead; // tableau associatif nomColonne => nomAttribut
    private $tcontent; // Tableau d'objets : contient tous les objets 
                       // dont on voudra afficher les attributs. 
    
    public function __construct($thead, $tcontent) {
        $this->thead = $thead;
        $this->tcontent = $tcontent; 
    }

    public function genererVoirPlus($objet, $texte="Voir plus") {
        $classe = $objet->getClass();
        $lien = "index.php?m2lMP=$classe&id=" . urlencode($objet->getId());
        $lien = "<a href=$lien>$texte</a>";
        return $lien;
    }

    public function genererSupprimer($objet) {
        $classe = $objet->getClass();
        // [cybersecu] Attention : vulnérabilité aux attaques CSRF 
        // TODO remodeler pour éviter les attaques csrf.
        $lien = "index.php?m2lMP=$classe&id=" . urlencode($objet->getId())."&supprimer=true";
        $lien = "<a href=$lien>Supprimer</a>";
        return $lien;
    }

    public function editer($genererLienVersObjet, $texte="Voir plus", $genererLienSupprimer=false) {
        // Générer un tableau à partir des objets et attributs. Renvoie 
        // Ce tableau sous forme de string. 
        $tableau = "<table>";
        $tableau .= "<thead>";
        foreach($this->thead as $key=>$val) {
            $tableau .= "<td>$key</td>";
        }
        $tableau .= "</thead><tbody>";
        foreach($this->tcontent as $objet) {
            $tableau .= "<tr>";

            foreach($this->thead as $key=>$val) {
                $method = "get" . ucfirst($val);
                // echo de débug : echo "tableau.php >  " .$method."\n". method_exists($objet, $method). "\n"; 
                if (method_exists($objet, $method)) 
                {
                    $attr = $objet->$method();
                    $tableau .= "<td>$attr</td>";
                } 
            }
            if ($genererLienVersObjet) {
                $lien = $this->genererVoirPlus($objet, $texte);
                $tableau .= "<td>$lien</td>";
            }
            if ($genererLienSupprimer) {
                $lien = $this->genererSupprimer($objet) ; 
                $tableau .= "<td>$lien</td>";
            }
            $tableau .= "</tr>";

        }
        $tableau .= "</tbody>";
        $tableau .= "</table>";
        return $tableau;
    }

    public static function editerAsTable($tcontent, $thead=[]) {
        // Prend en paramètre un tableau de tableaux et les renvoie sous forme de str <table></table>
        $ch = "<table><thead>";
        foreach ($thead as $k=>$elemHead) {
            $ch .= "<td>$elemHead</td>";
        }
        $ch.="</thead><tbody>";
        foreach ($tcontent as $ligne) {
            // echo var_dump($ligne);
            $ch.="<tr>";
            foreach($ligne as $k=>$v) {
                $ch.="<td>$v</td>";
            }
            
            $ch.="</tr>";
        }

        $ch.="</tbody></table>";
        return $ch;
    }

}