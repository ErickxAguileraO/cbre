@extends('layout.web')

@section('title', 'Documentos')

@section('content')
    @push('extra-css')
        <style>
            body {
                background-color: #F1F7F9;
            }

            .flex-noticias-home {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                width: 100%;
                background: #F1F7F9;
                padding-top: 10px;
                padding-bottom: 55px;
            }
        </style>
    @endpush

    <div class="contenido">
        <div class="portada">
            <img class="mostrar-escritorio" src="{{ asset('public/web/imagenes/portada-escritorio.svg') }}" alt="">
            <img class="mostrar-movil" src="{{ asset('public/web/imagenes/portada-movil.svg') }}" alt="">
        </div>
        <div class="sub-menu">
            <a href="/">Estás en <p>inicio</p></a>
            <p>></p>
            <a href="/edificios-oficinas">
                <p>Edificios y oficinas</p>
            </a>
            <p>></p>
            <a href="{{ $url_back }}">
                <p>{{ $nombre_edificio }}</p>
            </a>
            <p>></p>
            <a href="/noticias">Documentos</a>
        </div>
        <section class="flex-noticias-home">
            <p class="txt-busqueda" id="total-noticias"></p>
            <div class="noticias-home">
                <div class="lista-noticias" id="lista-noticias">
                    @forelse ($documentos as $doc)
                        <div class="noticia-home-n">
                            <a href="">
                                <div class="imgFormato">
                                    @if ($doc->doc_extension == 'pdf')
                                        <img src="{{ asset('public/web/imagenes/i-pdf.svg') }}" alt="">
                                    @elseif ($doc->doc_extension == 'docx')
                                        <img src="{{ asset('public/web/imagenes/i-doc.svg') }}" alt="">
                                    @elseif ($doc->doc_extension == 'png' || $doc->doc_extension == 'jpg' || $doc->doc_extension == 'jpeg')
                                        <img src="{{ asset('public/web/imagenes/i-img.svg') }}" alt="">
                                    @elseif ($doc->doc_extension == 'xlsx')
                                        <img src="{{ asset('public/web/imagenes/i-excel.svg') }}" alt="">
                                    @else
                                        <img src="{{ asset('public/web/imagenes/i-formato.svg') }}" alt="">
                                    @endif
                                </div>
                                <div class="contenido-noticia-n">
                                    <div class="date-noticia">
                                        <img src="public/web/imagenes/i-calendario.svg" alt="">
                                        <p>Publicado el {{ $doc->created_at }}</p>
                                    </div>
                                    <h2>{{ $doc->nombre }}</h2>
                                    <a href="{{ $doc->urlDocumento }}" target="_blank" class="ver-mas">
                                        <img src="{{ asset('public/web/imagenes/i-linea.svg') }}" alt="">
                                        <p>Descargar documento</p>
                                    </a>
                                </div>
                            </a>
                        </div>
                    @empty
                    <div>
                        <p>No hay documentos asociados al edificio</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
@endsection
