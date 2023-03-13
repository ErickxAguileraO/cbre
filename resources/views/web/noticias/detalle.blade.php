@extends('layout.web')

@section('title', $noticia->not_titulo)

@section('content')
    @push('extra-css')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        <style>
            body{
                background-color: #F1F7F9;
            }
        </style>
    @endpush

    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ asset('public/web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('public/web/imagenes/portada-movil.svg') }}" alt="">
        </div>

        <div class="flex-contenido-seccion">
            <div class="contenido-seccion">
                <div class="sub-menu">
                    <a href="/">Estás en <p>inicio</p></a>
                    <p>></p>
                    <a href="/noticias"> <p>Noticias</p></a>
                    <p>></p>
                    <a href="{{route('web.noticias.detalle', [$noticia->not_id, Str::slug($noticia->not_titulo , "-")])}}">{{ $noticia->not_titulo }}</a>
                </div>

                <div>
                    <img class="imagen-noticias-detalle" src="{{ $noticia->url_imagen }}" alt="">
                    <div class="fecha-noticia">
                        <img src="{{ asset('public/web/imagenes/i-calendario-negro.svg') }}" alt="">
                        <p>Publicado el {{$noticia->getFechaChileAttribute().' a las '.$noticia->getHoraAttribute()}}</p>
                    </div>
                    <h2>{{$noticia->not_titulo}}</h2>
                    <div class="compartir">
                        <p>Compartir en:</p>
                        <div>
                            {!! $shareComponent !!}
                        </div>
                    </div>
                    <div class="noticia-txt">
                        <p>
                            @php echo htmlspecialchars_decode($noticia->not_texto) @endphp
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
