<style>
    body{
        background-color: #edf2f7;
    }
</style>
<div style="font-family: Arial, sans-serif; font-size: 14px; color: #333; margin: 0 auto; max-width: 600px; background-color: #ffff">

    {{-- Cabecera con logo de la empresa --}}
    <div style="background-color: #012A2D; padding: 20px;">
        <svg style="max-width: 200px;" width="93" height="23" viewBox="0 0 93 23" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M38.5433 17.6071H30.8737V13.768H38.7156H38.7385H38.7615C39.7374 13.8823 40.4837 14.6935 40.4837 15.6533C40.4607 16.693 39.5882 17.5956 38.5433 17.6071ZM30.8737 4.99305H38.8993H38.9337H38.9567C39.8637 5.15301 40.5296 5.91853 40.5296 6.82116C40.5296 7.74665 39.8178 8.615 38.8763 8.74069L30.8622 8.75211L30.8737 4.99305ZM42.2863 11.1287C45.2256 10.1575 45.7537 7.70094 45.7537 5.70144C45.7537 2.63934 43.5837 0 37.1656 0H25.1904V22.9543H37.1311C43.5837 22.9543 45.9604 19.6637 45.9604 16.3502C45.9489 12.3626 42.2863 11.1287 42.2863 11.1287ZM72.7696 0V23H93V17.7556H78.3956V13.7452H91.5533V8.71783H78.3956L78.3841 5.0159H92.977L93 0H72.7696ZM64.0552 7.15251C63.9519 7.90661 63.1941 8.72926 62.2526 8.72926H54.3533V5.0616H62.2526C63.1941 5.0616 63.9404 5.74714 64.0552 6.6612V7.15251ZM60.9896 0.0342772H48.7619V23H54.3763V13.7109H60.5648C62.333 13.7337 63.7107 15.1848 63.7107 16.9672V22.9886H69.2104L69.1989 15.5733C69.1989 12.1341 65.8693 11.1287 65.8693 11.1287C65.8693 11.1287 69.2793 10.1118 69.2793 6.05564C69.2793 1.07402 64.9852 0.0342772 60.9896 0.0342772ZM21.5393 17.4471C21.4589 17.4471 13.8581 17.5956 11.2404 17.3443C7.01519 16.9329 5.52259 13.8137 5.52259 11.2772C5.52259 8.11227 7.69259 5.77 11.0567 5.33582C12.6526 5.13015 21.4015 5.22156 21.5048 5.22156H21.6885L21.7 0H21.5163L11.6078 0.0228515C10.5056 0.0914059 8.68 0.194237 6.80852 0.959762C5.00593 1.78241 3.44444 3.03925 2.27333 4.60457C0.792222 6.60407 0 8.9692 0 11.4486C0 12.2255 0.0574074 13.0025 0.183704 13.7452C0.895556 17.23 3.19185 20.1093 6.47556 21.6518C7.58926 22.1431 9.3 22.7258 12.7559 22.92C12.7674 22.92 14.6159 22.9543 14.6159 22.9543L21.5163 22.9657H21.7L21.723 17.4357L21.5393 17.4471Z" fill="white"/>
        </svg>
    </div>

    {{-- Cuerpo del mensaje --}}
    <div style="padding-left: 20px; padding-right: 20px; padding-top: 20px; padding-bottom: 20px">
        <h2 style="margin-bottom: 20px;">Bienvenido</h2>

        <p>Estimado/a, {{$request->nombre}} {{$request->apellidos ? : $request->apellido}}</p>
        <p>Le damos la bienvenida a nuestro sistema. Le hemos creado una cuenta de usuario con su dirección de correo electrónico.</p>
        <p>Para ingresar al sistema, es necesario que establezca una nueva contraseña. Por favor, siga los siguientes pasos:</p>
        <ol>
            <li>Diríjase a la siguiente dirección web: <a href="{{request()->secure() ? 'https://' : 'http://'.request()->getHost().'/login'}}">{{request()->secure() ? 'https://' : 'http://'.request()->getHost().'/login'}}</a></li>
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
                <svg xmlns="http://www.w3.org/2000/svg" width="7.501" height="15" viewBox="0 0 7.501 15">
                    <path id="facebook" d="M12.318,2.491h1.369V.106A17.683,17.683,0,0,0,11.693,0C9.718,0,8.366,1.242,8.366,3.524v2.1H6.187V8.291H8.366V15h2.671V8.292h2.091l.332-2.666H11.036V3.789c0-.771.208-1.3,1.282-1.3Z" transform="translate(-6.187)" fill="#fff"/>
                  </svg>
            </a>
            <a href="{{$datos_generales->dag_linkedin}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <svg id="linkedin" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                    <path id="Trazado_895" data-name="Trazado 895" d="M18.18,17.84h0v-5.5c0-2.691-.579-4.764-3.726-4.764a3.266,3.266,0,0,0-2.942,1.617h-.044V7.825H8.489V17.84H11.6V12.881c0-1.306.247-2.568,1.864-2.568,1.593,0,1.617,1.49,1.617,2.652V17.84Z" transform="translate(-3.183 -2.84)" fill="#fff"/>
                    <path id="Trazado_896" data-name="Trazado 896" d="M.4,7.977h3.11V17.991H.4Z" transform="translate(-0.149 -2.991)" fill="#fff"/>
                    <path id="Trazado_897" data-name="Trazado 897" d="M1.8,0A1.81,1.81,0,1,0,3.6,1.8,1.8,1.8,0,0,0,1.8,0Z" fill="#fff"/>
                  </svg>
            </a>
            <a href="{{$datos_generales->dag_instagram}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <svg id="instagram" xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 15 15">
                    <g id="Grupo_71" data-name="Grupo 71">
                      <g id="Grupo_70" data-name="Grupo 70">
                        <path id="Trazado_893" data-name="Trazado 893" d="M10.312,0H4.687A4.688,4.688,0,0,0,0,4.687v5.625A4.688,4.688,0,0,0,4.687,15h5.625A4.688,4.688,0,0,0,15,10.312V4.687A4.688,4.688,0,0,0,10.312,0Zm3.281,10.312a3.285,3.285,0,0,1-3.281,3.281H4.687a3.285,3.285,0,0,1-3.281-3.281V4.687A3.285,3.285,0,0,1,4.687,1.406h5.625a3.285,3.285,0,0,1,3.281,3.281Z" fill="#fff"/>
                      </g>
                    </g>
                    <g id="Grupo_73" data-name="Grupo 73" transform="translate(3.75 3.75)">
                      <g id="Grupo_72" data-name="Grupo 72">
                        <path id="Trazado_894" data-name="Trazado 894" d="M131.75,128a3.75,3.75,0,1,0,3.75,3.75A3.75,3.75,0,0,0,131.75,128Zm0,6.094a2.344,2.344,0,1,1,2.344-2.344A2.347,2.347,0,0,1,131.75,134.094Z" transform="translate(-128 -128)" fill="#fff"/>
                      </g>
                    </g>
                    <g id="Grupo_75" data-name="Grupo 75" transform="translate(11.032 2.969)">
                      <g id="Grupo_74" data-name="Grupo 74">
                        <circle id="Elipse_27" data-name="Elipse 27" cx="0.5" cy="0.5" r="0.5" fill="#fff"/>
                      </g>
                    </g>
                  </svg>
            </a>
            <a href="{{$datos_generales->dag_twitter}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <svg id="Grupo_29" data-name="Grupo 29" xmlns="http://www.w3.org/2000/svg" width="15.362" height="12.48" viewBox="0 0 15.362 12.48">
                    <path id="Trazado_18" data-name="Trazado 18" d="M15.362,49.477a6.565,6.565,0,0,1-1.814.5,3.128,3.128,0,0,0,1.385-1.74,6.293,6.293,0,0,1-2,.763,3.149,3.149,0,0,0-5.447,2.153,3.243,3.243,0,0,0,.073.718,8.913,8.913,0,0,1-6.491-3.294,3.15,3.15,0,0,0,.967,4.208A3.11,3.11,0,0,1,.614,52.4v.035a3.163,3.163,0,0,0,2.523,3.094,3.143,3.143,0,0,1-.828.1,2.784,2.784,0,0,1-.6-.053,3.179,3.179,0,0,0,2.944,2.194,6.327,6.327,0,0,1-3.9,1.343A5.9,5.9,0,0,1,0,59.067,8.865,8.865,0,0,0,4.831,60.48a8.9,8.9,0,0,0,8.962-8.96c0-.139,0-.276-.012-.407a6.282,6.282,0,0,0,1.58-1.636Z" transform="translate(0 -48)" fill="#fff"/>
                  </svg>
            </a>
            <a href="{{$datos_generales->dag_youtube}}" target="_blank" style="text-decoration: none; margin-right: 5px">
                <svg xmlns="http://www.w3.org/2000/svg" width="17.27" height="12.48" viewBox="0 0 17.27 12.48">
                    <path id="youtube" d="M8.633,12.98h0a45.772,45.772,0,0,1-6.433-.4A2.669,2.669,0,0,1,.318,10.7,19.589,19.589,0,0,1,0,6.757,19.957,19.957,0,0,1,.316,2.779v0A2.725,2.725,0,0,1,2.193.886l.007,0A47.463,47.463,0,0,1,8.629.5h.009a45.612,45.612,0,0,1,6.435.4,2.669,2.669,0,0,1,1.876,1.874,19,19,0,0,1,.318,4,19.643,19.643,0,0,1-.316,3.942v0a2.67,2.67,0,0,1-1.879,1.877h0a47.505,47.505,0,0,1-6.428.384ZM1.621,3.125a19.3,19.3,0,0,0-.271,3.623v.018a18.135,18.135,0,0,0,.271,3.59,1.316,1.316,0,0,0,.926.923,45.159,45.159,0,0,0,6.086.352,46.988,46.988,0,0,0,6.088-.339,1.316,1.316,0,0,0,.924-.923,18.2,18.2,0,0,0,.271-3.589c0-.007,0-.014,0-.021a17.564,17.564,0,0,0-.27-3.628v0A1.317,1.317,0,0,0,14.72,2.2a44.989,44.989,0,0,0-6.086-.352,47.052,47.052,0,0,0-6.087.339A1.353,1.353,0,0,0,1.621,3.125ZM16.3,10.542h0ZM6.914,9.472V4.008L11.636,6.74Zm0,0" transform="translate(0.001 -0.5)" fill="#fff"/>
                  </svg>
            </a>
        </div>
    </div>

</div>


