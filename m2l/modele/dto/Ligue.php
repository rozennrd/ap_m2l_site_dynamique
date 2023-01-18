<?php
class Ligue{
    use Hydrate;
    private $idLigue;
    private $nomLigue;
    private $site;
    private $descriptif;

    public function __construct( $unIdLigue,$unNomLigue){
		$this->idLigue = $unIdLigue;
		$this->nomLigue = $unNomLigue;
	}

  public function getIdLigue(){
    return $this->idLigue;
  }

  public function setIdLigue($unIdLigue){
    $this->idLigue = $unIdLigue;
  }

  public function getNomLigue(){
    return $this->nomLigue;
  }

  public function setNomLigue($unNomLigue){
    $this->nomLigue = $unNomLigue;
  }

  public function getSite(){
    return $this->site;
  }

  public function setSite($unSite){
    $this->site = $unSite;
  }

  public function getDescriptif(){
    return $this->descriptif;
  }

  public function setDescriptif($unDescriptif){
    $this->descriptif = $unDescriptif;
  }

}

?>