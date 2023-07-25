<div>
    {{-- Knowing others is intelligence; knowing yourself is true wisdom. --}}

    <div class="contenedor__modalFile" wire:ignore.self>
        <div class="modalFile">
            <div class="modalFile__header">
                <h3>Adjuntar archivos</h3>
            </div>
            <div class="modalFile__contenedorContenido">
                <h3 style="text-align: center;">¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
                <div class="div-input-file">
                    <input class="hide" type="file" name="archivoUpload" id="archivoUpload" wire:model.defer="files" value="" multiple>
                    <label class="label-input-100 pointer" for="archivoUpload">
                        <div wire:loading wire:target="files" class="spinner-border file-spinner text-dark"></div>
                        <img wire:loading.remove wire:target="files" src="/public/images/admin/sistema/cloud.svg" alt="">
                        <p>click aquí para seleccionar</p>
                    </label>
                </div>
                <div class="modalFile__contenido">
                    @if ($archivos->count() > 0)
                    <div class="tabla-archivos-subidos" id="listaArchivos">
                        @foreach ($archivos as $archivo)
                        <div class="archivo-subido-n">
                            <p>{{$archivo->arcf_nombre_original}}</p>
                            <p>{{ pathinfo($archivo->arcf_nombre_original, PATHINFO_EXTENSION) }}</p>
                            <button wire:click="deleteFile({{$archivo->arcf_id}})" wire:loading.attr="disabled" class="btn btn-link text-decoration-none">
                                <img src="/public/images/admin/sistema/delete.svg" class="btn btn-remove" alt="">
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
            </div>

            <div class="modalFile__botones">
                <div class="modalFile__cerrarBtn modalFile__btnN modalFile__botonSecundario" onclick="cerrarModal()">Cerrar</div>
                @if ($archivos->count() > 0)
                    <div class="modalFile__btnN modalFile__botonPrimario" onclick="cerrarModal()">Listo</div>
                    @else
                    <div class="modalFile__btnN modalFile__botonPrimario bg-secondary" disabled>Listo</div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function cerrarModal() {
            document.querySelector(".contenedor__modalFile").style.display = "none";
        }
    </script>
    <script>
        window.addEventListener('show-uploadFileModal', event =>{
            document.querySelector(".contenedor__modalFile").style.display = "flex";
        });
         window.addEventListener('close-uploadFileModal', event =>{
            document.querySelector(".contenedor__modalFile").style.display = "none";
        });
    </script>

</div>
