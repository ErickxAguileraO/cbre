<body style="background-color:#edf2f7;">
<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; margin: 0 auto; max-width: 600px; background-color: #ffff">

    {{-- Cabecera con logo de la empresa --}}
    <div style="background-color: #012A2D; padding: 20px;">
        <img src="http://cbre.aeurus.cl/public/web/imagenes/logo-white.png" alt="">
    </div>

    {{-- Cuerpo del mensaje --}}
    <div style="padding-left: 20px; padding-right: 20px; padding-top: 20px; padding-bottom: 20px">
        <h2 style="margin-bottom: 20px;">Bienvenido</h2>

        <p>Estimado/a, {{$request->nombre}} {{$request->apellidos ? : $request->apellido}}</p>
        <p>Le damos la bienvenida a nuestro sistema. Le hemos creado una cuenta de usuario con su dirección de correo electrónico.</p>
        <p>Para ingresar al sistema, es necesario que establezca una nueva contraseña. Por favor, siga los siguientes pasos:</p>
        <ol>
            @if ($user->administrador)
            <li>Diríjase a la siguiente dirección web: <a href="{{request()->secure() ? 'https://' : 'http://'.request()->getHost().'/login'}}">{{request()->secure() ? 'https://' : 'http://'.request()->getHost().'/login'}}</a></li>
                @else
            <li>Diríjase a la siguiente dirección web: <a href="{{request()->secure() ? 'https://' : 'http://'. $user->funcionario->edificio->edi_subdominio .request()->getHost().'/login'}}">{{request()->secure() ? 'https://' : 'http://'.request()->getHost().'/login'}}</a></li>
            @endif
            <li>Haga clic en el botón "Cambiar contraseña" y escriba su dirección de correo electrónico.</li>
            <li>Revise su correo electrónico para encontrar el mensaje de notificación de restablecimiento de contraseña enviado por nuestro sistema. El mensaje incluirá un enlace para acceder al mantenedor de contraseñas.</li>
            <li>Siga las instrucciones del mantenedor para establecer su nueva contraseña. Le recomendamos elegir una contraseña segura y fácil de recordar.</li>
        </ol>
        <p>Una vez que haya establecido su nueva contraseña, podrá ingresar al sistema con sus nuevas credenciales. Si tiene algún problema o duda, no dude en ponerse en contacto con nuestro equipo de soporte técnico.</p>
        <p>Atentamente,</p>
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


