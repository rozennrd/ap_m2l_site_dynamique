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

    public function genererVoirPlus($objet) {
        $classe = $objet->get_class();
        $lien = "index.php?m2lMP=$classe?id=" . urlencode($objet->getId());
        $lien = "<a href=$lien>Voir Plus</a>";
        return $lien;
    }

    public function editer($genererLienVersObjet) {
        // Générer un tableau à partir des objets et attributs. Renvoie 
        // Ce tableau sous forme de string. 
        $tableau = "<table>";
        $tableau .= "<thead>";
        foreach($this->thead as $key=>$val) {
            $tableau .= "<td>$key</td>";
        }
        $tableau .= "</thead><tbody>";
        echo "bonjour"; 
        echo $this->tcontent->getNbFormations;
        foreach($this->tcontent as $objet) {
            echo "intitulés : ";
            echo $objet->getIntitule(); 
            $tableau .= "<tr>";
            foreach($this->thead as $key=>$val) {
                $method = "get" . ucfirst($val);
                echo $method; 
                if (method_exists($objet, $method)) 
                {
                    $attr = $objet->method();
                    $tableau .= "<td>$attr</td>";
                }
                    
            }
            if ($genererLienVersObjet) {
                $lien = $this->genererVoirPlus($objet);
                $tableau .= "<td>$lien</td>";
            }
            $tableau .= "</tr>";
        }
        $tableau .= "</tbody>";
        $tableau .= "</table>";
        return $tableau;
    }



}