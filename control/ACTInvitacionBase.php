<?php
/**
*@package pXP
*@file gen-ACTInvitacionBase.php
*@author  (egutierrez)
*@date 27-12-2019 16:11:47
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
#12				27-12-2019 16:11:47	    EGS					CREACION

*/

class ACTInvitacionBase extends ACTbase{    
			
	function listarInvitacionBase(){
		$this->objParam->defecto('ordenacion','id_invitacion_base');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODInvitacionBase','listarInvitacionBase');
		} else{
			$this->objFunc=$this->create('MODInvitacionBase');
			
			$this->res=$this->objFunc->listarInvitacionBase($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarInvitacionBase(){
		$this->objFunc=$this->create('MODInvitacionBase');	
		if($this->objParam->insertar('id_invitacion_base')){
			$this->res=$this->objFunc->insertarInvitacionBase($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarInvitacionBase($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarInvitacionBase(){
			$this->objFunc=$this->create('MODInvitacionBase');	
		$this->res=$this->objFunc->eliminarInvitacionBase($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>