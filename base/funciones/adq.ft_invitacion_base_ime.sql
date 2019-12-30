--------------- SQL ---------------

CREATE OR REPLACE FUNCTION adq.ft_invitacion_base_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:        Adquisiciones
 FUNCION:         adq.ft_invitacion_base_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'adq.tinvitacion_base'
 AUTOR:          (egutierrez)
 FECHA:            27-12-2019 16:11:47
 COMENTARIOS:
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE                FECHA                AUTOR                DESCRIPCION
 #12                  27-12-2019 16:11:47  EGS                  Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'adq.tinvitacion_base'
 #
 ***************************************************************************/

DECLARE

    v_nro_requerimiento        integer;
    v_parametros               record;
    v_id_requerimiento         integer;
    v_resp                    varchar;
    v_nombre_funcion        text;
    v_mensaje_error         text;
    v_id_invitacion_base    integer;

BEGIN

    v_nombre_funcion = 'adq.ft_invitacion_base_ime';
    v_parametros = pxp.f_get_record(p_tabla);

    /*********************************
     #TRANSACCION:  'ADQ_INVB_INS'
     #DESCRIPCION:    Insercion de registros
     #AUTOR:        egutierrez
     #FECHA:        27-12-2019 16:11:47
    ***********************************/

    if(p_transaccion='ADQ_INVB_INS')then

        begin
            --Sentencia de la insercion
            insert into adq.tinvitacion_base(
            codigo,
            descripcion,
            fecha_est,
            estado_reg,
            id_usuario_ai,
            fecha_reg,
            usuario_ai,
            id_usuario_reg,
            fecha_mod,
            id_usuario_mod
              ) values(
            replace(upper(v_parametros.codigo),' ',''),
            v_parametros.descripcion,
            v_parametros.fecha_est,
            'activo',
            v_parametros._id_usuario_ai,
            now(),
            v_parametros._nombre_usuario_ai,
            p_id_usuario,
            null,
            null



            )RETURNING id_invitacion_base into v_id_invitacion_base;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Invitacion  almacenado(a) con exito (id_invitacion_base'||v_id_invitacion_base||')');
            v_resp = pxp.f_agrega_clave(v_resp,'id_invitacion_base',v_id_invitacion_base::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

    /*********************************
     #TRANSACCION:  'ADQ_INVB_MOD'
     #DESCRIPCION:    Modificacion de registros
     #AUTOR:        egutierrez
     #FECHA:        27-12-2019 16:11:47
    ***********************************/

    elsif(p_transaccion='ADQ_INVB_MOD')then

        begin
            --Sentencia de la modificacion
            update adq.tinvitacion_base set
            codigo = replace(upper(v_parametros.codigo),' ',''),
            descripcion = v_parametros.descripcion,
            fecha_est = v_parametros.fecha_est,
            fecha_mod = now(),
            id_usuario_mod = p_id_usuario,
            id_usuario_ai = v_parametros._id_usuario_ai,
            usuario_ai = v_parametros._nombre_usuario_ai
            where id_invitacion_base=v_parametros.id_invitacion_base;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Invitacion  modificado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_invitacion_base',v_parametros.id_invitacion_base::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

    /*********************************
     #TRANSACCION:  'ADQ_INVB_ELI'
     #DESCRIPCION:    Eliminacion de registros
     #AUTOR:        egutierrez
     #FECHA:        27-12-2019 16:11:47
    ***********************************/

    elsif(p_transaccion='ADQ_INVB_ELI')then

        begin
            --Sentencia de la eliminacion
            delete from adq.tinvitacion_base
            where id_invitacion_base=v_parametros.id_invitacion_base;

            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','Invitacion  eliminado(a)');
            v_resp = pxp.f_agrega_clave(v_resp,'id_invitacion_base',v_parametros.id_invitacion_base::varchar);

            --Devuelve la respuesta
            return v_resp;

        end;

    else

        raise exception 'Transaccion inexistente: %',p_transaccion;

    end if;

EXCEPTION

    WHEN OTHERS THEN
        v_resp='';
        v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
        v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
        v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
        raise exception '%',v_resp;

END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;