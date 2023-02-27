@extends('layout.admin')
@section('title', 'Contactos')

@section('content')
   <h1>Contacto detalle</h1>
   <div class="row mb-5">
    <div class="col-lg-6 col-12">
       <div class="container mt-3">
          <table class="table">
             <tbody>
                <tr>
                   <td class="font-weight-bold">Fecha:</td>
                   <td>{{ ucfirst($contacto->created_at->isoFormat('MMMM Do YYYY, h:mm:ss a')) }}</td>
                </tr>
                   <tr>
                      <td class="font-weight-bold">Nombre:</td>
                      <td>{{ $contacto->con_nombre_completo }}</td>
                   </tr>
                <tr>
                   <td class="font-weight-bold">Email:</td>
                   <td>{{ $contacto->con_email }}</td>
                </tr>
                <tr>
                   <td class="font-weight-bold">Teléfono:</td>
                   <td>{{ $contacto->con_telefono }}</td>
                </tr>
                <tr>
                    <td class="font-weight-bold">Mensaje:</td>
                    <td>{{ $contacto->con_mensaje}}</td>
                 </tr>
             </tbody>
          </table>
       </div>
    </div>
 </div>
@endsection
@push('scripts')
   <script src="{{ asset('public/js/admin/sistema/contactos/listado.js') }}"></script>
@endpush
