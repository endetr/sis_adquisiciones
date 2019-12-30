<?php
/**
 * @package sis_tesoreria
 * @file (valvarado)
 * @date 27-12-2019 09:28:00
 * @description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
 */

class MODTipoDatoExtra extends MODbase
{

    function __construct(CTParametro $pParam)
    {
        parent::__construct($pParam);
    }

    function listar()
    {

        $this->procedimiento = 'adq.ft_tipo_dato_extra_sel';
        $this->transaccion = 'ADQ_TDE_SEL';
        $this->tipo_procedimiento = 'SEL';

        $this->captura('id_tipo_dato_extra', 'int4');
        $this->captura('tabla', 'varchar');
        $this->captura('codigo', 'varchar');
        $this->captura('nombre', 'varchar');
        $this->captura('descripcion', 'varchar');
        $this->captura('ayuda', 'varchar');
        $this->captura('tipo_dato', 'varchar');
        $this->captura('tipo', 'varchar');
        $this->captura('estado_reg', 'varchar');
        $this->captura('fecha_mod', 'timestamp');
        $this->captura('fecha_reg', 'timestamp');

        $this->armarConsulta();
        $this->ejecutarConsulta();

        return $this->respuesta;
    }

    function insertar()
    {

        $this->procedimiento = 'adq.ft_tipo_dato_extra_ime';
        $this->transaccion = 'ADQ_TDE_INS';
        $this->tipo_procedimiento = 'IME';

        $this->setParametro('tabla', 'tabla', 'varchar');
        $this->setParametro('codigo', 'codigo', 'varchar');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('ayuda', 'ayuda', 'varchar');
        $this->setParametro('tipo_dato', 'tipo_dato', 'varchar');
        $this->setParametro('tipo', 'tipo', 'varchar');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('fecha_mod', 'fecha_mod', 'timestamp');
        $this->setParametro('fecha_reg', 'fecha_reg', 'timestamp');

        $this->armarConsulta();
        $this->ejecutarConsulta();

        return $this->respuesta;
    }

    function modificar()
    {

        $this->procedimiento = 'adq.ft_tipo_dato_extra_ime';
        $this->transaccion = 'ADQ_TDE_MOD';
        $this->tipo_procedimiento = 'IME';

        $this->setParametro('id_tipo_dato_extra', 'id_tipo_dato_extra', 'int4');
        $this->setParametro('tabla', 'tabla', 'varchar');
        $this->setParametro('codigo', 'codigo', 'varchar');
        $this->setParametro('nombre', 'nombre', 'varchar');
        $this->setParametro('descripcion', 'descripcion', 'varchar');
        $this->setParametro('ayuda', 'ayuda', 'varchar');
        $this->setParametro('tipo_dato', 'tipo_dato', 'varchar');
        $this->setParametro('tipo', 'tipo', 'varchar');
        $this->setParametro('estado_reg', 'estado_reg', 'varchar');
        $this->setParametro('fecha_mod', 'fecha_mod', 'timestamp');
        $this->setParametro('fecha_reg', 'fecha_reg', 'timestamp');

        $this->armarConsulta();
        $this->ejecutarConsulta();

        return $this->respuesta;
    }

    function eliminar()
    {

        $this->procedimiento = 'adq.ft_tipo_dato_extra_ime';
        $this->transaccion = 'ADQ_TDE_ELI';
        $this->tipo_procedimiento = 'IME';

        $this->setParametro('id_tipo_dato_extra', 'id_tipo_dato_extra', 'int4');

        $this->armarConsulta();
        $this->ejecutarConsulta();

        return $this->respuesta;
    }

    function listarTablas()
    {

        $this->procedimiento = 'adq.ft_tipo_dato_extra_sel';
        $this->transaccion = 'ADQ_TABLA_SEL';
        $this->tipo_procedimiento = 'SEL';

        $this->captura('nombre_tabla', 'text');

        $this->armarConsulta();
        $this->ejecutarConsulta();

        return $this->respuesta;
    }
}

?>
