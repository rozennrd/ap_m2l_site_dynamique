<?php
class Ligue{
    use Hydrate;
    private idLigue;
    private nomLigue;
    private site;
    private descriptif;

    public function __construct( $unIdLigue  ,  $unNomLigue){
		$this->idLigue = $unIdLigue;
		$this->nomLigue = $unNomLigue;
	}

}

?>