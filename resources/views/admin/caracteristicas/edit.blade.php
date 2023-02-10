@extends('layout.admin')
@section('title', 'Caracteristicas')

@section('content')

    <h1>Editar Característica</h1>

    <form action="#" method="POST" id="form-caracteristica" class="formulario">
        @csrf
        <input type="hidden" id="car_id" value="{{ $caracteristica->car_id }}">
        <fieldset class="row">
            <div class="col-sm-4">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input id="nombre" name="nombre" value="{{ $caracteristica->car_nombre }}" class="form-control"
                        type="text" tabindex="1" />
                    @error('nombre')
                        <p class="field-message-alert"> {{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="video">Video</label>
                    <input name="video" type="text" value="{{ $caracteristica->car_video_url }}" class="form-control"
                        id="video" tabindex="3" />
                    @error('video')
                        <p class="field-message-alert"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="posicion">Posición</label>
                    <input name="posicion" type="number" value="{{ $caracteristica->car_posicion }}" class="form-control"
                        id="posicion" tabindex="2" />
                    @error('posicion')
                        <p class="field-message-alert"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="row">
            <div class="col-sm-2">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <select id="estado" name="estado" class="form-control" tabindex="4" style="width:100%;">
                        <option value="1"{{ $caracteristica->car_estado == 1 ? 'selected' : '' }}>Activo</option>
                        <option value="0"{{ $caracteristica->car_estado == 0 ? 'selected' : '' }}>Inactivo</option>
                    </select>
                    @error('estado')
                        <p class="field-message-alert"> {{ $message }}</p>
                    @enderror
                </div>
            </div>
        </fieldset>
        <fieldset class="row my-3">
            <div class="col-sm-4">
                <div class="custom-file">
                    <input type="file" class="custom-file-input imagen-input" id="file" name="file"
                        lang="es" accept=".jpg,.jpeg,.png,.svg">
                    <label class="custom-file-label" for="imagen-input">Seleccionar Archivo</label>
                </div>
            </div>
        </fieldset>
        <fieldset class="row mt-5">
            <div class="col-sm-8">
                <div class="form-group">
                    <button id="editar" type="submit" class="btn btn-primary btn-lg" value="Guardar"
                    class="btn btn-primary btn-lg" type="button">
                    <div id="default" class="d-block">
                        <span class="mr-2">Editar</span>
                    </div>
                    <div id="loading" class="d-none">
                        <span class="mr-2">Editando</span>
                        <span class="spinner-border spinner-border-md" role="status" aria-hidden="true"></span>
                    </div>
                </button>
                </div>
            </div>
        </fieldset>
    </form>
@endsection

@push('scripts')
    <script src="{{ asset('public\js\admin\caracteristicas\caracterisitca_edit.js') }}"></script>
@endpush
