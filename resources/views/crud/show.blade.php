@extends("layout.main")
@section("contenido")
<div class="container">
    <div class="row">
        <div class="col">
            <h2>Detalles del cliente a eliminar</h2>
            <h4>Una vez eliminado el cliente, no podrá ser recuperado</h4>
            <hr>
            <p><strong>Nombre:</strong> {{ $cliente->name }}
            <p><strong>Correo:</strong> {{ $cliente->email }}
            <p><strong>Telefono:</strong> {{ $cliente->phone }}
             <p><strong>Estatus:</strong> {{ $cliente->status }}
                <hr>
                <form action="{{ route("cliente.destroy", $cliente->id)}}" method="post"
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Eliminar</button>
                            
                            </form> 
                <a href="{{ route('cliente.index') }}" class="btn btn-info px-4 border mt-3">
                                    Regresar
                                </a>
        </div>
    </div>
</div>
@endsection