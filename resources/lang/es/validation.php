<?php

return array(
    "accepted" => ":attribute debe ser aceptado.",
    "active_url" => ":attribute no es una URL valida.",
    "after" => ":attribute debe contener una fecha despues :date.",
    "alpha" => ":attribute solo debe contener caracteres.",
    "alpha_dash" => ":attribute solo puede contener letras, numeros y guiones.",
    "alpha_num" => ":attribute solo puede contener letras y numeros.",
    "array" => ":attribute debe ser un array.",
    "before" => ":attribute debe ser una fecha antes a :date.",
    "between" => array(
        "numeric" => ":attribute debe tener entre :min y :max.",
        "file" => ":attribute debe tener entre :min y :max kilobytes.",
        "string" => ":attribute debe tener entre :min y :max caracteres.",
        "array" => ":attribute debe tener entre :min y :max items.",
    ),
    "confirmed" => ":attribute de confirmaci&oacute;n no coincide.",
    "date" => ":attribute no es una fecha valida.",
    "date_format" => ":attribute does not match the format :format.",
    "different" => ":attribute and :other must be different.",
    "digits" => ":attribute debe ser :digits digitos.",
    "digits_between" => ":attribute debe estar entre :min y :max digitos.",
    'dimensions' => 'El :attribute tiene dimensiones de imagen no válidas.',
    "email" => ":attribute formato invalido.",
    "exists" => "seleccione :attribute es invalido.",
    "image" => ":attribute debe ser una imagen.",
    "in" => ":attribute es invalido.",
    "integer" => ":attribute debe ser un numerico.",
    "ip" => ":attribute must be a valid IP address.",
    "max" => array(
        "numeric" => ":attribute no debe ser mayor a :max.",
        "file" => ":attribute no debe ser mayor a :max kilobytes.",
        "string" => ":attribute no debe ser mayor a :max caracteres.",
        "array" => ":attribute no debe ser mayor a :max items.",
    ),
    "mimes" => ":attribute debe ser de tipo: :values.",
    "min" => array(
        "numeric" => ":attribute debe contener minimo :min.",
        "file" => ":attribute debe contener minimo :min kilobytes.",
        "string" => ":attribute debe contener minimo :min caracteres.",
        "array" => ":attribute debe contener minimo :min items.",
    ),
    "not_in" => ":attribute seleccionado es invalido.",
    "numeric" => ":attribute debe ser numerico.",
    "regex" => "formato :attribute no cumple con las condiciones definidas.",
    "required" => ":attribute es requerido.",
    "required_if" => ":attribute field is required when :other is :value.",
    "required_with" => ":attribute field is required when :values is present.",
    "required_without" => ":attribute field is required when :values is not present.",
    "same" => ":attribute and :other must match.",
    "size" => array(
        "numeric" => ":attribute must be :size.",
        "file" => ":attribute must be :size kilobytes.",
        "string" => ":attribute must be :size characters.",
        "array" => ":attribute must contain :size items.",
    ),
    "unique" => ":attribute ya se encuentra registrado.",
    "url" => ":attribute format is invalid.",
    "recaptcha" => ':attribute no se digito correctamente.',
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Language Lines
      |--------------------------------------------------------------------------
      |
      | Here you may specify custom validation messages for attributes using the
      | convention "attribute.rule" to name the lines. This makes it quick to
      | specify a specific custom language line for a given attribute rule.
      |
     */
    'custom' => array(
        'g-recaptcha-response' => [
            'required' => 'Por favor marca la casilla "No soy un robot".',
            'captcha' => 'Error de verificación de la captcha para robots. Inténtalo más tarde o contacta con nosotros.',
        ],
    ),
    /*
      |--------------------------------------------------------------------------
      | Custom Validation Attributes
      |--------------------------------------------------------------------------
      |
      | The following language lines are used to swap attribute place-holders
      | with something more reader friendly such as E-Mail Address instead
      | of "email". This simply helps us make messages a little cleaner.
      |
     */
    'attributes' => array(
        'descripcion_kr' => 'Descripción',
        'meta_kr' => 'Meta',
        'descripcion_ini' => 'Descripción',
        'meta_ini' => 'Meta',
        'fecha_entrega_ini' => 'Fecha de entrega',
        'fecha_entrega_kr' => 'Fecha de entrega',
        'fecha_inicia_kr' => 'Fecha de inicio',
        'tendencia_ini' => 'Tendencia',
        'tendencia_kr' => 'Tendencia',
        'id_responsable_ini' => 'Responsable',
        'id_responsable_kr' => 'Responsable',
        'responsables_ini' => 'Responsables',
        'responsables_kr' => 'Responsables',
        'meta_minima_kr' => 'Meta Mínima',
        'meta_maxima_kr' => 'Meta Máxima',
        'periodo_kr' => 'Periodo',
        'medicion_kr' => 'Medición',
        'nombre_area' => 'Nombre Área',
        'nombre_area_upd' => 'Nombre Área',
        'padre' => 'Padre',
        'padre_upd' => 'Padre',
        'jerarquia' => 'Jerárquia',
        'jerarquia_upd' => 'Jerárquia',
        'estado_upd' => 'Estado',
        'nombre_cargo' => 'Nombre Cargo',
        'nombre_cargo_upd' => 'Nombre Cargo',
        'area' => 'Área',
        'area_upd' => 'Área',
        'nivel_jerarquico' => 'Nivel Jerárquico',
        'nivel_jerarquico_upd' => 'Nivel Jerárquico',
        'nivel_general' => 'Nivel General',
        'nivel_general_upd' => 'Nivel General',
        'id_empresa' => 'Id Empresa',
        'id_area' => 'Id área',
        'id_colaborador' => 'Id Colaborador',
        'perfil-imagen' => 'Foto Fomulario',
        'foto' => 'foto',
        'documento' => 'Código o Documento',
        'nombre' => 'Nombre',
        'genero' => 'Genero',
        'fecha_ingreso' => 'Fecha de Ingreso',
        'antiguedad' => 'Antiguedad',
        'correo'  => 'Correo',
        'antiguedad_anios' => 'Antiguedad Años',
        'antiguedad_meses' => 'Antiguedad Meses',
        'antiguedad_dias' => 'Antiguedad Días',
        'telefono_movil' => 'Teléfono Móvil',
        'telefono_fijo' => 'Teléfono Fijo',
        'id_cargo' => 'Cargo',
        'id_posicion' => 'Posición',
        'unidad_estrategica' => 'Unidad Estrátegica',
        'role' => 'Rol',
        'password' => 'Contraseña',
        'estado' => 'Estado',
        'lider' => 'Lider'
    ),
);
