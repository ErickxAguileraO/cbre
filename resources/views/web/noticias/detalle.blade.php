@extends('layout.web')

@section('title', 'Inicio')

@section('content')
    @push('extra-css')
        <style>
            body{
                background-color: #F1F7F9;
            }
        </style>
    @endpush
    
    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ asset('web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('web/imagenes/portada-movil.svg') }}" alt="">
        </div>

        <div class="flex-contenido-seccion">
            <div class="contenido-seccion">
                <div class="sub-menu">
                    <a href="/">Estás en <p>inicio</p></a>
                    <p>></p>
                    <a href="/noticias"> <p>Noticias</p></a>
                    <p>></p>
                    <a href="/noticias-detalle">Detalle noticia</a>
                </div>

                <div>
                    <img class="portada-noticia" src="{{ asset('web/imagenes/img-noticia.svg') }}" alt="">
                    <div class="fecha-noticia">
                        <img src="{{ asset('web/imagenes/i-calendario-negro.svg') }}" alt="">
                        <p>Publicado el 21 Enero 2023</p>
                    </div>
                    <h2>But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain was born and I will give you a complete</h2>
                    <div class="compartir">
                        <p>Compartir en:</p>
                        <div>
                            <a href=""><img src="{{ asset('web/imagenes/i-fb-negro.svg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('web/imagenes/i-twt-negro.svg') }}" alt=""></a>
                            <a href=""><img src="{{ asset('web/imagenes/i-wspp-negro.svg') }}" alt=""></a>
                        </div>
                    </div>
                    <div class="noticia-txt">
                        <p>
                            At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. <br>

Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerumAt vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. <br>

Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum
                        </p>
                    </div>
                    <p></p>
                </div>
            </div>
        </div>
    </div>

    @push('extra-js')
   
    @endpush

@endsection
