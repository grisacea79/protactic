@extends("layout.main")
@section("contenido")
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="h2">Crear nuevo cliente</div>
                <form action="{{ route("cliente.store") }}" method="post">
                    @csrf
                    @method("post")
                    <div class="mb-3">
                        <label for="cliente_name" class="form-label">Nombre contacto</label>
                        <input class="form-control"   placeholder="Nombre contatco" id="cliente_name" name="name" required></input>
                    </div>
                   <div class="mb-3">
                        <label for="cliente_email" class="form-label">Correo de contacto</label>
                         <input type="email" class="form-control"  placeholder="name@example.com"  id="cliente_email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="cliente_phone" class="form-label">Teléfono</label>
                        <input class="form-control"   placeholder="telefono a 10 digitos" id="cliente_phone" name="phone" required></input>
                    </div>
                    
                 
                     <!-- Campo: Estatus (Corregido a SELECT para evitar errores) -->
                            <div class="mb-3">
                                <label for="cliente_status" class="form-label fw-semibold">Estatus</label>
                                <select class="form-select" id="cliente_status" name="status" required>
                                    <option value="activo" >Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </div>
                    <button type="submit" class="btn btn-primary mt-3">Guardar</button>
                    <a href="{{ route("cliente.index") }}" class="btn btn-info mt-3">Regresar</a>
                </form>
            </div>
        </div>
    </div>
@endsection