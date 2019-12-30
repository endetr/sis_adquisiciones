<?php
/**
*@package pXP
*@file gen-MODInvitacionBase.php
*@author  (egutierrez)
*@date 27-12-2019 16:11:47
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				    AUTOR				DESCRIPCION
 #12				27-12-2019 16:11:47	    EGS					CREACION

*/

class MODInvitacionBase extends MODbase{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarInvitacionBase(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='adq.ft_invitacion_base_sel';
		$this->transaccion='ADQ_INVB_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_invitacion_base','int4');
		$this->captura('codigo','varchar');
		$this->captura('descripcion','varchar');
		$this->captura('fecha_est','date');
		$this->captura('estado_reg','varchar');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_reg','timestamp');
		$this->captura('usuario_ai','varchar');
		$this->captura('id_usuario_reg','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarInvitacionBase(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='adq.ft_invitacion_base_ime';
		$this->transaccion='ADQ_INVB_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('fecha_est','fecha_est','date');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarInvitacionBase(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='adq.ft_invitacion_base_ime';
		$this->transaccion='ADQ_INVB_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_invitacion_base','id_invitacion_base','int4');
		$this->setParametro('codigo','codigo','varchar');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('fecha_est','fecha_est','date');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarInvitacionBase(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='adq.ft_invitacion_base_ime';
		$this->transaccion='ADQ_INVB_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_invitacion_base','id_invitacion_base','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
}
?>