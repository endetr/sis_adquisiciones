CREATE OR REPLACE FUNCTION adq.ft_tipo_dato_extra_sel(p_administrador integer,
                                                      p_id_usuario integer,
                                                      p_tabla varchar,
                                                      p_transaccion varchar)
    RETURNS varchar AS
$body$
DECLARE

    v_consulta       varchar;
    v_parametros     record;
    v_nombre_funcion text;
    v_resp           varchar;
    v_filtro         varchar;

BEGIN

    v_nombre_funcion = 'adq.ft_tipo_dato_extra_sel';
    v_parametros = pxp.f_get_record(p_tabla);

    if (p_transaccion = 'ADQ_TDE_SEL') then

        begin

            v_consulta := 'select tipo.id_tipo_dato_extra,
                               tipo.tabla,
                               tipo.codigo,
                               tipo.nombre,
                               tipo.descripcion,
                               tipo.ayuda,
                               tipo.tipo_dato,
                               tipo.tipo,
                               tipo.estado_reg,
                               tipo.fecha_mod,
                               tipo.fecha_reg
                        from adq.ttipo_dato_extra tipo
				        where tipo.estado_reg = ''activo'' and ';

            v_consulta := v_consulta || v_parametros.filtro;
            v_consulta := v_consulta || ' order by ' || v_parametros.ordenacion || ' ' ||
                          v_parametros.dir_ordenacion || ' limit ' ||
                          v_parametros.cantidad || ' offset ' || v_parametros.puntero;
            RETURN v_consulta;

        end;


    elsif (p_transaccion = 'ADQ_TDE_CONT') then

        begin
            v_consulta := 'select count(id_tipo_dato_extra)
                        from adq.ttipo_dato_extra tipo
					    where ';

            v_consulta := v_consulta || v_parametros.filtro;

            return v_consulta;

        end;
    elsif (p_transaccion = 'ADQ_TABLA_SEL') then

        begin
            v_consulta := 'select tablas.nombre_tabla  from
                                (SELECT *, concat(table_schema ,''.'',table_name) as nombre_tabla FROM information_schema.tables
                                WHERE table_type =''BASE TABLE'') as tablas where ';

            v_consulta := v_consulta || v_parametros.filtro;
            v_consulta := v_consulta || ' order by ' || v_parametros.ordenacion || ' ' ||
                          v_parametros.dir_ordenacion || ' limit ' ||
                          v_parametros.cantidad || ' offset ' || v_parametros.puntero;
            RETURN v_consulta;

        end;


    elsif (p_transaccion = 'ADQ_TABLA_CONT') then

        begin
            v_consulta := 'select count(tablas.nombre_tabla) from
                                (SELECT *, concat(table_schema ,''.'',table_name) as nombre_tabla FROM information_schema.tables
                                WHERE table_type =''BASE TABLE'') as tablas where ';

            v_consulta := v_consulta || v_parametros.filtro;

            return v_consulta;

        end;
    else
        raise exception 'Transaccion inexistente';

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
    STABLE
    CALLED ON NULL INPUT
    SECURITY INVOKER
    COST 100;

alter function adq.ft_tipo_dato_extra_sel(integer, integer, varchar, varchar) owner to postgres;