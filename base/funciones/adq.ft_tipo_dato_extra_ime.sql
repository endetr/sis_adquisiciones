CREATE OR REPLACE FUNCTION adq.ft_tipo_dato_extra_ime(p_administrador integer,
                                                      p_id_usuario integer,
                                                      p_tabla varchar,
                                                      p_transaccion varchar)
    RETURNS varchar AS
$body$
DECLARE
    v_parametros         record;
    v_resp               varchar;
    v_nombre_funcion     varchar;
    v_id_tipo_dato_extra decimal;
    v_codigo             varchar;
BEGIN

    v_nombre_funcion = 'ads.ft_tipo_dato_extra_ime';
    v_parametros = pxp.f_get_record(p_tabla);
    if (p_transaccion = 'ADQ_TDE_INS') then
        begin

            IF exists(SELECT t.codigo
                      FROM adq.ttipo_dato_extra t
                      WHERE t.codigo = v_parametros.codigo
                        AND t.tabla = v_parametros.tabla
                      limit 1) THEN

                raise exception 'El c&oacute;digo % ya se encuentra en uso.', v_parametros.codigo;
            END IF;

            insert into adq.ttipo_dato_extra(tabla,
                                             codigo,
                                             nombre,
                                             descripcion,
                                             ayuda,
                                             tipo_dato,
                                             tipo,
                                             estado_reg,
                                             fecha_reg,
                                             id_usuario_reg,
                                             id_usuario_ai,
                                             usuario_ai)
            values (v_parametros.tabla,
                    v_parametros.codigo,
                    v_parametros.nombre,
                    v_parametros.descripcion,
                    v_parametros.ayuda,
                    v_parametros.tipo_dato,
                    v_parametros.tipo,
                    'activo',
                    now(),
                    p_id_usuario,
                    v_parametros._id_usuario_ai,
                    v_parametros._nombre_usuario_ai)
            RETURNING id_tipo_dato_extra into v_id_tipo_dato_extra;

            v_resp = pxp.f_agrega_clave(v_resp, 'mensaje',
                                        'Tipo Dato registrado con exito !!!');
            v_resp = pxp.f_agrega_clave(v_resp, 'id_tipo_dato_extra', v_id_tipo_dato_extra::varchar);

            return v_resp;
        end;
    elsif (p_transaccion = 'ADQ_TDE_MOD') then

        begin
            select t.codigo into v_codigo from adq.ttipo_dato_extra t where t.id_tipo_dato_extra = v_parametros.id_tipo_dato_extra;

            if v_codigo != v_parametros.codigo then
                IF exists(SELECT t.codigo
                          FROM adq.ttipo_dato_extra t
                          WHERE t.codigo = v_parametros.codigo
                            AND t.tabla = v_parametros.tabla
                          limit 1) THEN

                    raise exception 'El c&oacute;digo % ya se encuentra en uso.', v_parametros.codigo;
                END IF;
            end if;

            update adq.ttipo_dato_extra
            set tabla          = v_parametros.tabla,
                codigo         = v_parametros.codigo,
                nombre         = v_parametros.nombre,
                descripcion    = v_parametros.descripcion,
                ayuda          = v_parametros.ayuda,
                tipo_dato      = v_parametros.tipo_dato,
                tipo           = v_parametros.tipo,
                fecha_mod      = now(),
                id_usuario_ai  = v_parametros._id_usuario_ai,
                id_usuario_mod = p_id_usuario,
                usuario_ai     = v_parametros._nombre_usuario_ai
            where id_tipo_dato_extra = v_parametros.id_tipo_dato_extra;

            v_resp = pxp.f_agrega_clave(v_resp, 'mensaje', 'Tipo dato modificado con &eacute;xito');
            v_resp = pxp.f_agrega_clave(v_resp, 'id_tipo_dato_extra', v_parametros.id_tipo_dato_extra::varchar);

            return v_resp;
        end;

    elsif (p_transaccion = 'ADQ_TDE_ELI') then

        begin

            update adq.ttipo_dato_extra
            set estado_reg = 'inactivo'
            where id_tipo_dato_extra = v_parametros.id_tipo_dato_extra;

            v_resp = pxp.f_agrega_clave(v_resp, 'mensaje', 'Tipo dato eliminado con &eacute;xito !!!');
            v_resp = pxp.f_agrega_clave(v_resp, 'id_tipo_dato_extra', v_parametros.id_tipo_dato_extra::varchar);

            return v_resp;
        end;
    else
        raise exception 'Transaccion inexistente: %',p_transaccion;

    end if;

EXCEPTION

    WHEN OTHERS THEN
        v_resp = '';
        v_resp = pxp.f_agrega_clave(v_resp, 'mensaje', SQLERRM);
        v_resp = pxp.f_agrega_clave(v_resp, 'codigo_error', SQLSTATE);
        v_resp = pxp.f_agrega_clave(v_resp, 'procedimientos', v_nombre_funcion);
        raise exception '%',v_resp;

END;
$body$
    LANGUAGE 'plpgsql'
    VOLATILE
    CALLED ON NULL INPUT
    SECURITY INVOKER
    COST 100;

ALTER FUNCTION adq.ft_tipo_dato_extra_ime (p_administrador integer, p_id_usuario integer, p_tabla varchar, p_transaccion varchar)
    OWNER TO postgres;