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
                    <input class="hide" type="file" name="archivoUpload" id="archivoUpload" wire:model.defer="files" value="">
                    <label class="label-input-100 pointer" for="archivoUpload">
                        <img src="/public/images/admin/sistema/cloud.svg" alt="">
                        <p>click aquí para seleccionar</p>
                    </label>
                </div>
                <div class="modalFile__contenido">
                    <div class="" id="listaArchivos">
                        @foreach ($archivos as $archivo)
                            <div class="ml-5 text-center">
                                <span>{{$archivo->arcf_nombre_original}}</span>
                                <img wire:click="deleteFile({{$archivo->arcf_id}})" class="pointer" src="/public/images/admin/sistema/delete.svg" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="modalFile__botones">
                <div class="modalFile__cerrarBtn modalFile__btnN modalFile__botonSecundario" onclick="cerrarModal()">Cerrar</div>
            </div>
        </div>
    </div>

    <script>
        // Función para cerrar el modal
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
