<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="author" content="Aeurus Ltda.">
   <title>Login</title>
   <!-- CSS -->
   <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">
   <link href="{{ asset('public/js/admin/jquery/bootstrap/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset('public/css/admin/login.css') }}" rel="stylesheet" type="text/css">
   <link href="{{ asset('public/js/admin/jquery/sweetalert2/css/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />

   <!-- favicon -->
   <link href="{{ asset('public/images/admin/logo-white.svg') }}" rel="shortcut icon" />
</head>

<body>
   <div id="wrapper">
      <!-- contenido -->
      <div id="login">
         <figure class="fondo-verde-cbre rounded"><img src="{{ asset('public/images/admin/logo-white.svg') }}" width="100" height="64" alt="Intranet" /></figure>
         <h1>Iniciar sesión</h1>
         <form action="" class="form-horizontal" id="formLogin" name="formLogin" method="POST">
            @csrf
            <fieldset>
               <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" placeholder="Email" />
                  <small id="errorEmail" class="field-message-alert invisible absolute text-left"></small>
               </div>
               <div class="form-group">
                  <label for="password">Contraseña</label>
                  <input type="password" name="password" id="password" placeholder="Contraseña" />
                  <small id="errorPassword" class="field-message-alert invisible absolute"></small>
               </div>
               <div class="text-center">
                  <button type="submit" id="ingresarButton" class="btn boton-submit-formulario">Ingresar</button>
                  <br />
                  <br />
                  <button type="button" class="btn btn-link" id="passwordResetButton">Recuperar contraseña</button>
               </div>
            </fieldset>
         </form>
      </div>
   </div>
   <div id="aeurus">
      <a onclick="this.target='_blank'" onkeypress="this.target='_blank'" href="http://www.aeurus.cl/" title="Diseño Web - Posicionamiento Web - Sistema Web">
         <img width="22" height="22" src="{{ asset('/public/images/admin/aeurus.png') }}" alt="Diseño Web - Posicionamiento Web - Sistema Web" />
      </a>
   </div>


   <!-- JS -->
   <script src="{{ asset('public/js/admin/jquery/3.6.0/jquery-3.6.0.min.js') }}"></script>
   <script src="{{ asset('public/js/admin/jquery/bootstrap/bootstrap.min.js') }}"></script>
   <script src="{{ asset('public/js/admin/jquery/sweetalert2/js/sweetalert2.min.js') }}"></script>
   <script src="{{ asset('public/js/admin/sistema/auth/form_login.js') }}"></script>
</body>

</html>