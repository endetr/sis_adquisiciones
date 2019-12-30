<?php
/**
 * @package sis_tesoreria
 * @file (valvarado)
 * @date 27-12-2019 09:28:00
 * @description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
 */

class ACTTipoDatoExtra extends ACTbase
{

    function listar()
    {
        $this->objParam->defecto('ordenacion', 'id_tipo_dato_extra');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODTipoDatoExtra', 'listar');
        } else {
            $this->objFunc = $this->create('MODTipoDatoExtra');
            $this->res = $this->objFunc->listar($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function insertar()
    {
        $this->objFunc = $this->create('MODTipoDatoExtra');
        if ($this->objParam->insertar('id_tipo_dato_extra')) {
            $this->res = $this->objFunc->insertar($this->objParam);
        } else {
            $this->res = $this->objFunc->modificar($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function eliminar()
    {
        $this->objFunc = $this->create('MODTipoDatoExtra');
        $this->res = $this->objFunc->eliminar($this->objParam);
        $this->res->imprimirRespuesta($this->res->generarJson());
    }

    function listarTablas()
    {
        $this->objParam->defecto('ordenacion', 'id_tipo_dato_extra');
        $this->objParam->defecto('dir_ordenacion', 'asc');

        if ($this->objParam->getParametro('tipoReporte') == 'excel_grid' || $this->objParam->getParametro('tipoReporte') == 'pdf_grid') {
            $this->objReporte = new Reporte($this->objParam, $this);
            $this->res = $this->objReporte->generarReporteListado('MODTipoDatoExtra', 'listarTablas');
        } else {
            $this->objFunc = $this->create('MODTipoDatoExtra');
            $this->res = $this->objFunc->listarTablas($this->objParam);
        }
        $this->res->imprimirRespuesta($this->res->generarJson());
    }
}

?>
