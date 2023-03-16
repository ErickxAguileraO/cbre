<body style="background-color:#edf2f7;">
<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; margin: 0 auto; max-width: 600px; background-color: #ffff">

    {{-- Cabecera con logo de la empresa --}}
    <div style="background-color: #012A2D; padding: 20px;">
        <img src="http://cbre.aeurus.cl/public/web/imagenes/logo-white.png" alt="">
    </div>

    {{-- Cuerpo del mensaje --}}
    <div style="padding-left: 20px; padding-right: 20px; padding-top: 20px;">
        <h2 style="margin-bottom: 20px;">Nuevo mensaje de contacto</h2>
        <p>Estimado/a, {{$datos_generales->dag_nombre_encargado}}</p>
        <p>Le informamos que ha recibido un nuevo mensaje de contacto en su sitio web. Los detalles del mensaje se indican a continuación:</p>
    </div>

    <div style="padding: 28px">
        <div style="margin-bottom: 20px;">
            <span style="display: block; font-weight: bold; margin-bottom: 5px;">Nombre:</span>
            <span>{{ $request->nombre }}</span>
        </div>

        <div style="margin-bottom: 20px;">
            <span style="display: block; font-weight: bold; margin-bottom: 5px;">Email:</span>
            <span>{{ $request->email }}</span>
        </div>

        <div style="margin-bottom: 20px;">
            <span style="display: block; font-weight: bold; margin-bottom: 5px;">Teléfono:</span>
            <span>+56 {{ $request->telefono }}</span>
        </div>

        <div style="margin-bottom: 20px;">
            <span style="display: block; font-weight: bold; margin-bottom: 5px;">Mensaje:</span>
            <span>{{ $request->mensaje }}</span>
        </div>
    </div>

    {{-- Pie de página con información de la empresa --}}
    <div style="background-color: #012A2D; padding: 20px; color: #ffff; text-align: center;">
        <p>{{$datos_generales->dag_direccion}}</p>
        <p>{{$datos_generales->comuna->com_nombre}}, {{$datos_generales->comuna->region->reg_nombre}}</p>
        <p>+56 {{ PrintPhone($datos_generales->dag_telefono_uno)}}</p>
        <p>+56 {{ PrintPhone($datos_generales->dag_telefono_dos)}}</p>
        <div>
            <a href="{{$datos_generales->dag_facebook}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <img src="http://cbre.aeurus.cl/public/web/imagenes/i-fb.png" alt="">
            </a>
            <a href="{{$datos_generales->dag_linkedin}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <img src="http://cbre.aeurus.cl/public/web/imagenes/i-link.png" alt="">
            </a>
            <a href="{{$datos_generales->dag_instagram}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <img src="http://cbre.aeurus.cl/public/web/imagenes/i-ig.png" alt="">
            </a>
            <a href="{{$datos_generales->dag_twitter}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <img src="http://cbre.aeurus.cl/public/web/imagenes/i-twt.png" alt="">
            </a>
            <a href="{{$datos_generales->dag_youtube}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <img src="http://cbre.aeurus.cl/public/web/imagenes/i-yt.png" alt="">
            </a>
        </div>
    </div>

</div>


