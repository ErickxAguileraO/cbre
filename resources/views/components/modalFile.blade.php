{{-- Modal archivos --}}
{{-- <div class="contenedor__modalFile">
    <div class="modalFile">
        <div class="modalFile__header">
            <h3>Adjuntar archivos</h3>
        </div>
        <div class="modalFile__contenedorContenido">
            <h3 style="text-align: center;">¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
            <div class="div-input-file">
                <input class="hide" type="file" name="archivoUpload" id="archivoUpload" value="">
                <label class="label-input-100" for="archivoUpload">
                    <img src="/public/images/admin/sistema/cloud.svg"alt="">
                    <p>click aquí para seleccionar</p>
                </label>
            </div>
            <div class="modalFile__contenido">
                <div class="tabla-archivos-subidos">
                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>

                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>

                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>

                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>

                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>

                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>


                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>

                    <div class="archivo-subido-n">
                        <p>Nombre archivo</p>
                        <p>PDF</p>
                        <img src="/public/images/admin/sistema/delete.svg" class="btn-remove-archivo" alt="">
                    </div>
                </div>
            </div>
        </div>

        <div class="modalFile__botones">
            <div class="modalFile__cerrarBtn modalFile__btnN modalFile__botonSecundario">Cerrar</div>
            <div class="modalFile__btnN modalFile__botonPrimario">Guardar</div>
        </div>

    </div>
</div> --}}
{{-- Modal archivos --}}
<div class="contenedor__modalFile">
    <div class="modalFile">
        <div class="modalFile__header">
            <h3>Adjuntar archivos</h3>
        </div>
        <div class="modalFile__contenedorContenido">
            <h3 style="text-align: center;">¿Cuando fue la ultima vez que se realizó mantención al ascensor principal?</h3>
            <div class="div-input-file">
                <input class="hide" type="file" name="archivoUpload" id="archivoUpload" value="" onchange="agregarArchivo(event)">
                <label class="label-input-100" for="archivoUpload">
                    <img src="/public/images/admin/sistema/cloud.svg" alt="">
                    <p>click aquí para seleccionar</p>
                </label>
            </div>
            <div class="modalFile__contenido">
                <div class="tabla-archivos-subidos" id="listaArchivos"></div>
            </div>
        </div>

        <div class="modalFile__botones">
            <div class="modalFile__cerrarBtn modalFile__btnN modalFile__botonSecundario" onclick="cerrarModal()">Cerrar</div>
            <div class="modalFile__btnN modalFile__botonPrimario" onclick="guardarArchivos()">Guardar</div>
        </div>

    </div>
</div>
@push('scripts')
    <script>
        // JavaScript para manejar la lista de archivos y su visualización

        // Variable para almacenar la lista de archivos seleccionados
        let archivosSeleccionados = [];

        // Función para agregar un archivo a la lista y mostrarlo en pantalla
        function agregarArchivo(event) {
            let archivo = event.target.files[0];
            archivosSeleccionados.push(archivo);

            let listaArchivos = document.getElementById("listaArchivos");
            let nuevoElemento = document.createElement("div");
            nuevoElemento.classList.add("archivo-subido-n");

            let nombreArchivo = document.createElement("p");
            nombreArchivo.textContent = archivo.name;
            nuevoElemento.appendChild(nombreArchivo);

            let tipoArchivo = document.createElement("p");
            tipoArchivo.textContent = obtenerTipoArchivo(archivo);
            nuevoElemento.appendChild(tipoArchivo);

            let botonEliminar = document.createElement("img");
            botonEliminar.src = "/public/images/admin/sistema/delete.svg";
            botonEliminar.classList.add("btn-remove-archivo");
            botonEliminar.alt = "Eliminar archivo";
            botonEliminar.addEventListener("click", function() {
                quitarArchivo(archivosSeleccionados.indexOf(archivo));
            });
            nuevoElemento.appendChild(botonEliminar);

            listaArchivos.appendChild(nuevoElemento);
        }

        // Función para quitar un archivo de la lista y actualizar la visualización
        function quitarArchivo(index) {
            archivosSeleccionados.splice(index, 1);
            let listaArchivos = document.getElementById("listaArchivos");
            listaArchivos.removeChild(listaArchivos.childNodes[index]);
        }

        // Función para obtener el tipo de archivo basado en su extensión
        function obtenerTipoArchivo(archivo) {
            let extension = archivo.name.split(".").pop().toLowerCase();
            if (extension === "pdf") {
                return "PDF";
            } else if (extension === "jpg" || extension === "jpeg" || extension === "png") {
                return "Imagen";
            } else {
                return "Archivo";
            }
        }

        // Función para cerrar el modal
        function cerrarModal() {
            let modal = document.querySelector(".contenedor__modalFile");
            modal.style.display = "none";
        }

        // Función para guardar los archivos en la base de datos
        function guardarArchivos() {
            // Aquí puedes enviar los archivos al servidor y guardarlos en la base de datos
            // utilizando la lista de archivos almacenados en la variable "archivosSeleccionados"

            // Cerrar el modal
            cerrarModal();
        }
    </script>
@endpush
