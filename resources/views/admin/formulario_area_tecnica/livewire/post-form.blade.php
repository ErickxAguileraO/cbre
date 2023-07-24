<div>
    {{-- Success is as dangerous as failure. --}}

            {{-- Modal Publicar --}}
    <div class="contenedor__modalPublicar" wire:ignore.self>
        <div class="modalFile">
            <div class="modalFile__header">
                <h3>Adjuntar archivos</h3>
            </div>
            <div class="modalFile__contenedorContenido">

                <p class="mb-2">Destinatarios</p>

                <div wire:ignore>
                    <select id="mySelect" class="form-control" style="width:100%;" wire:model="selectedEdificioId">
                        <option value="">Select an edificio</option>
                        @foreach ($edificios as $edificio)
                            <option value="{{$edificio->edi_id}}">{{$edificio->edi_nombre}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="modalFile__contenido">
                    @if ($formulario->edificios->count() > 0)
                    <div class="tabla-archivos-subidos">
                        @foreach ($formulario->edificios as $edificio)
                        <div class="archivo-subido-n">
                            <p>{{$edificio->edi_nombre}}</p>
                            <img wire:click="detachEdificio({{$edificio->edi_id}})" src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo pointer"
                                alt="">
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

            </div>

            <div class="modalFile__botones">
                <div class="modalPublicar__cerrarBtn modalFile__btnN modalFile__botonSecundario" wire:click="detachAll">Cancelar</div>
                @if ($formulario->edificios->count() > 0)
                        <button class="modalFile__btnN modalFile__botonPrimario" id="postear-formulario">Publicar y enviar</button>
                    @else
                        <button class="modalFile__btnN modalFile__botonPrimario bg-secondary" disabled id="postear-formulario">Publicar y enviar</button>
                @endif
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        $(document).ready(function () {
            Livewire.on('edificioSelected', function (edificioId) {
                Livewire.emit('attachEdificio', edificioId);
            });

            $('#mySelect').on('change', function () {
                var edificioId = $(this).val();
                Livewire.emit('edificioSelected', edificioId);
            });

            $('#mySelect').select2();
        });
    </script>
    @endpush
</div>
