@extends("layout.main")
@section("contenido")
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-8 col-lg-6">
                
                <div class="card shadow-sm border-0 rounded-3">
                    <div class="card-body p-4 p-sm-5">
                        
                        <h2 class="fw-bold text-dark mb-4 text-center">Modificar Proyecto</h2>
                        
                        <form action="{{ route('proyecto.update', $proyecto->id) }}" method="POST">
                            @csrf
                            @method('PUT') <!-- Requerido por Laravel para actualizaciones -->

                            <!-- MENÚ DESPLEGABLE: Selección de Cliente Responsable -->
                            <div class="mb-3">
                                <label for="client_id" class="form-label fw-semibold">Cliente responsable</label>
                                <select class="form-select" id="client_id" name="client_id" required>
                                    @foreach($clientes as $cliente)
                                        <option value="{{ $cliente->id }}" 
                                            {{ old('client_id', $proyecto->client_id) == $cliente->id ? 'selected' : '' }}>
                                            {{ $cliente->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Campo: Nombre del Proyecto -->
                            <div class="mb-3">
                                <label for="proyecto_name" class="form-label fw-semibold">Nombre del proyecto</label>
                                <input type="text" class="form-control" placeholder="Ej. Desarrollo de Tienda Online" 
                                       id="proyecto_name" name="name" value="{{ old('name', $proyecto->name) }}" required>
                            </div>

                            <!-- Campo: Descripción -->
                            <div class="mb-3">
                                <label for="proyecto_description" class="form-label fw-semibold">Descripción</label>
                                <textarea class="form-control" placeholder="Escribe los objetivos del proyecto..." 
                                          id="proyecto_description" name="description" rows="3" required>{{ old('description', $proyecto->description) }}</textarea>
                            </div>

                            <!-- Campo: Estatus -->
                            <div class="mb-3">
                                <label for="proyecto_status" class="form-label fw-semibold">Estatus actual</label>
                                <select class="form-select" id="proyecto_status" name="status" required>
                                    <option value="planeacion" {{ old('status', $proyecto->status) == 'planeacion' ? 'selected' : '' }}>En Planeación</option>
                                    <option value="proceso" {{ old('status', $proyecto->status) == 'proceso' ? 'selected' : '' }}>En Proceso</option>
                                    <option value="terminado" {{ old('status', $proyecto->status) == 'terminado' ? 'selected' : '' }}>Terminado</option>
                                </select>
                            </div>

                            <!-- Campos: Fechas -->
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="start_date" class="form-label fw-semibold">Fecha de Inicio</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" 
                                           value="{{ old('start_date', $proyecto->start_date) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label fw-semibold">Fecha de Entrega</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" 
                                           value="{{ old('end_date', $proyecto->end_date) }}" required>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="d-flex gap-2 mt-4">
                                <button type="submit" class="btn btn-warning px-4 fw-semibold text-dark shadow-sm">
                                    Guardar Cambios
                                </button>
                                <a href="{{ route('cliente.index') }}" class="btn btn-light px-4 border">
                                    Regresar
                                </a>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection