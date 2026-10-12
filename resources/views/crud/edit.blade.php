@extends("layout.main")
@section("contenido")
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="h2">Actualizar cliente</div>
                
                        <form action="{{ route('cliente.update', $cliente->id) }}" method="POST">
                            @csrf
                            @method("PUT")

                            <!-- Campo: Nombre -->
                            <div class="mb-3">
                                <label for="cliente_name" class="form-label fw-semibold">Nombre de contacto</label>
                                <input type="text" class="form-control" placeholder="Nombre contacto" 
                                       value="{{ old('name', $cliente->name) }}" id="cliente_name" name="name" required>
                            </div>

                            <!-- Campo: Correo -->
                            <div class="mb-3">
                                <label for="cliente_email" class="form-label fw-semibold">Correo de contacto</label>
                                 <input type="email" class="form-control" placeholder="name@example.com" 
                                        value="{{ old('email', $cliente->email) }}" id="cliente_email" name="email" required>
                            </div>

                            <!-- Campo: Teléfono -->
                            <div class="mb-3">
                                <label for="cliente_phone" class="form-label fw-semibold">Teléfono</label>
                                <input type="tel" class="form-control" placeholder="Teléfono a 10 dígitos"
                                       value="{{ old('phone', $cliente->phone) }}" id="cliente_phone" name="phone" required>
                            </div>
                            
                            <!-- Campo: Estatus (Corregido a SELECT para evitar errores) -->
                            <div class="mb-3">
                                <label for="cliente_status" class="form-label fw-semibold">Estatus</label>
                                <select class="form-select" id="cliente_status" name="status" required>
                                    <option value="activo" {{ old('status', $cliente->status) == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ old('status', $cliente->status) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            <!-- Botones alineados horizontalmente -->
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-warning px-4 fw-semibold text-dark shadow-sm">
                                   Actualizar
                                </button>
                                <a href="{{ route('cliente.index') }}" class="btn btn-light px-4 border">
                                    Regresar
                                </a>
                            </div>

                        </form>
            </div>
        </div>
    </div>
@endsection