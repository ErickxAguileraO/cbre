{{-- Modal Publicar --}}

<form action="#" method="POST" id="form-observacion" class="formulario">
    @csrf
    <div id="modalObersacion" class="contenedor__modalObservacion">
        <div class="modalFile">
            <div class="modalFile__header">
                <h3>Agregar Observación</h3>
                <input name="idForm" id="idForm" type="hidden" value="{{$estado->foredi_id}}">
                <input name="idEdificio" id="idEdificio" type="hidden" value="{{$estado->foredi_edificio_id}}">
            </div>
            <div class="modalFile__contenedorContenido">

                <p>Observación</p>
                <div class="modalFile__contenido">
                    <div class="form-group">
                        <textarea name="descripcion" id="descripcion" class="form-control" cols="30" rows="10"></textarea>
                        <small id="" class="field-message-alert absolute"></small>
                    </div>
                </div>
            </div>

            <div class="modalFile__botones">
                <div class="modalObservacion__cerrarBtn modalFile__btnN modalFile__botonSecundario">Cancelar</div>
                <button id="guardar" type="submit" value="Guardar" class="modalFile__btnN modalFile__botonPrimario">Si, enviar
                    <div id="loading" class="d-none">
                        <div id="default" class="d-block">
                            <span>Guardar</span>
                            <i class="fas fa-save ml-2 mr-2"></i>
                        </div>
                        <span class="spinner-border spinner-border-md ml-1" role="status" aria-hidden="true"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
</form>


@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/area_tecnica/form_agregar.js') }}"></script>
@endpush
