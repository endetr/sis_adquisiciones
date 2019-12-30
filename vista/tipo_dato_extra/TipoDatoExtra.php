<?php
/**
 * @package sis_tesoreria
 * @file TipoDatoExtra.php
 * @author (valvarado)
 * @date 27-12-2019 09:32:00
 * @description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 */

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
    Phx.vista.TipoDatoExtra = Ext.extend(Phx.gridInterfaz, {
        nombreVista: 'TipoDatoExtra',
        fheight: '50%',
        cls: 'Tipo Dato',
        fwidth: '30%',
        tam_pag: 50,
        title: 'Tipo de Datos Extra',
        ActSave: '../../sis_adquisiciones/control/TipoDatoExtra/insertar',
        ActDel: '../../sis_adquisiciones/control/TipoDatoExtra/eliminar',
        ActList: '../../sis_adquisiciones/control/TipoDatoExtra/listar',
        id_store: 'id_tipo_dato_extra',
        bdel: true,
        bsave: false,
        bedit: true,
        bnew: true,
        bexcel: false,
        Atributos: [
            {
                config: {
                    labelSeparator: '',
                    inputType: 'hidden',
                    name: 'id_tipo_dato_extra'
                },
                type: 'Field',
                form: true
            },
            {
                config: {
                    name: 'tabla',
                    fieldLabel: 'Referencia Tabla',
                    emptyText: 'Selecciona la tabla propietaria',
                    typeAhead: true,
                    lazyRender: true,
                    allowBlank: false,
                    mode: 'remote',
                    gwidth: 180,
                    anchor: '100%',
                    store: new Ext.data.JsonStore({
                        url: '../../sis_adquisiciones/control/TipoDatoExtra/listarTablas',
                        id: 'nombre_tabla',
                        root: 'datos',
                        sortInfo: {
                            field: 'nombre_tabla',
                            direction: 'ASC'
                        },
                        totalProperty: 'total',
                        fields: ['nombre_tabla'],
                        remoteSort: true,
                        baseParams: {par_filtro: 'nombre_tabla'}
                    }),
                    valueField: 'nombre_tabla',
                    displayField: 'nombre_tabla',
                    gdisplayField: 'nombre_tabla',
                    hiddenName: 'nombre_tabla',
                    forceSelection: true,
                    typeAhead: false,
                    triggerAction: 'all',
                    lazyRender: true,
                    mode: 'remote',
                    pageSize: 10,
                    queryDelay: 1000,
                    resizable: true,
                    minChars: 1,
                    renderer: function (value, p, record) {
                        return String.format('{0}', record.data['tabla']);
                    }
                },
                type: 'ComboBox',
                id_grupo: 2,
                filters: {pfiltro: 'tipo.tabla', type: 'string'},
                grid: true,
                form: true,
                bottom_filter: true
            },
            {
                config: {
                    name: 'nombre',
                    fieldLabel: 'Nombre',
                    allowBlank: false,
                    anchor: '100%',
                    width: '100%',
                    maxLength: 150
                },
                type: 'TextField',
                filters: {pfiltro: 'tipo.nombre', type: 'string'},
                id_grupo: 1,
                grid: true,
                form: true
            },
            {
                config: {
                    name: 'codigo',
                    fieldLabel: 'codigo',
                    allowBlank: false,
                    anchor: '100%',
                    width: '100%',
                    regex: new RegExp('^[a-zA-Z_][a-zA-Z0-9_]*$'),
                    maxLength: 150
                },
                type: 'TextField',
                filters: {pfiltro: 'tipo.codigo', type: 'string'},
                id_grupo: 1,
                grid: true,
                form: true
            },
            {
                config: {
                    name: 'descripcion',
                    fieldLabel: 'Descripci&oacute;n',
                    allowBlank: true,
                    anchor: '100%',
                    width: '100%',
                    maxLength: 500
                },
                type: 'TextField',
                filters: {pfiltro: 'tipo.descripcion', type: 'string'},
                id_grupo: 1,
                grid: true,
                form: true
            },
            {
                config: {
                    name: 'ayuda',
                    fieldLabel: 'Ayuda',
                    allowBlank: true,
                    anchor: '100%',
                    width: '100%',
                    maxLength: 300
                },
                type: 'TextField',
                filters: {pfiltro: 'tipo.ayuda', type: 'string'},
                id_grupo: 1,
                grid: true,
                form: true
            },
            {
                config: {
                    name: 'tipo_dato',
                    fieldLabel: 'Tipo Dato',
                    allowBlank: false,
                    anchor: '100%',
                    width: '100%',
                    maxLength: 50
                },
                type: 'TextField',
                filters: {pfiltro: 'tipo.tipo_dato', type: 'string'},
                id_grupo: 1,
                grid: true,
                form: true
            },
            {
                config: {
                    name: 'tipo',
                    fieldLabel: 'Tipo',
                    allowBlank: false,
                    gwidth: 180,
                    anchor: '100%',
                    store: ['INVITACION', 'COTIZACION'],
                },
                type: 'ComboBox',
                id_grupo: 1,
                filters: {pfiltro: 'tipo.tipo', type: 'string'},
                grid: true,
                form: true,
            },
            {
                config: {
                    name: 'fecha_mod',
                    fieldLabel: 'Ultima Modificaci&oacute;n',
                    allowBlank: true,
                    anchor: '100%',
                    width: '100%',
                    maxLength: 50
                },
                type: 'DateField',
                filters: {pfiltro: 'tipo.fecha_mod', type: 'string'},
                id_grupo: 1,
                grid: true,
                form: false
            }
        ],
        fields: [
            {name: 'id_tipo_dato_extra', type: 'numeric'},
            {name: 'tabla', type: 'string'},
            {name: 'codigo', type: 'string'},
            {name: 'nombre', type: 'string'},
            {name: 'descripcion', type: 'string'},
            {name: 'ayuda', type: 'string'},
            {name: 'tipo_dato', type: 'string'},
            {name: 'tipo', type: 'string'},
            {name: 'fecha_mod', type: 'date'},
            {name: 'fecha_reg', type: 'date'},
        ],
        sortInfo: {
            field: 'fecha_mod',
            direction: 'DESC'
        },
        constructor: function (config) {
            this.maestro = config;
            Phx.vista.TipoDatoExtra.superclass.constructor.call(this, config);
            this.iniciarEventos();
            this.load({params: {start: 0, limit: this.tam_pag}});
            this.init();
        },
        liberaMenu: function () {
            var tb = Phx.vista.TipoDatoExtra.superclass.liberaMenu.call(this);
            return tb
        },
        preparaMenu: function (n) {
            var data = this.getSelectedData();
            var tb = this.tbar;
            if (data) {
                this.getBoton('edit').enable();
                this.getBoton('new').enable();
                this.getBoton('del').enable();
            }
            return tb
        },
        iniciarEventos: function () {
            var self = this;
            var nombre = self.getComponente('nombre');
            nombre.on("change", function (ele, newValue, oldValue) {
                self.actualizarCodigo(newValue);
            });
        },
        actualizarCodigo: function (valor) {
            var self = this;
            var codigo = self.getComponente('codigo');
            codigo.setValue(valor.toLowerCase().replace(/\s/g, '_'));
        }

    });

</script>