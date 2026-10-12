@extends("layout.main")

@section("contenido")
    <div class="container my-4">
        <div class="row">
            <div class="col">
                 <!-- BARRA DE BÚSQUEDA IMPLEMENTADA -->
    <div class="card bg-light border-0 shadow-sm mb-4">
        <div class="card-body py-3">
            <!-- El formulario recarga la misma página mandando el texto por GET -->
            <form action="{{ url()->current() }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">🔍</span>
                        <!-- Conserva el valor buscado usando value="{{ $search ?? '' }}" -->
                        <input type="text" 
                               name="search" 
                               class="form-control border-start-0 ps-0" 
                               placeholder="Buscar proyecto por nombre..." 
                               value="{{ $search ?? '' }}">
                    </div>
                </div>
                <div class="col-md-3 d-flex gap-2">
                    <button type="submit" class="btn btn-primary w-100 fw-semibold">Buscar</button>
                    @if(request()->filled('search'))
                        <!-- Botón de limpieza rápida que aparece solo si hay una búsqueda activa -->
                        <a href="{{ url()->current() }}" class="btn btn-outline-secondary">Limpiar</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
    
                <div class="h2">Crear nuevo proyecto</div>
                
                <!-- El formulario apunta al controlador de proyectos -->
                <form action="{{ route('proyecto.store') }}" method="post">
                    @csrf
                    <!-- Nota: El método POST no requiere la directiva @method("post") porque es el nativo de HTML -->

                    <!-- MENÚ DESPLEGABLE: Para seleccionar a qué cliente pertenece este proyecto -->
                    <div class="mb-3">
                        <label for="client_id" class="form-label fw-semibold">Cliente responsable</label>
                        <select class="form-select" id="client_id" name="client_id" required>
                            <option value="" selected disabled>Selecciona el cliente...</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Campo: Nombre del Proyecto -->
                    <div class="mb-3">
                        <label for="proyecto_name" class="form-label">Nombre del proyecto</label>
                        <input type="text" class="form-control" placeholder="Ej. Desarrollo de Sitio Web" id="proyecto_name" name="name" required>
                    </div>

                    <!-- Campo: Descripción -->
                    <div class="mb-3">
                        <label for="proyecto_description" class="form-label">Descripción</label>
                        <input type="text" class="form-control" placeholder="Breve descripción del alcance" id="proyecto_description" name="description" required>
                    </div>

                    <!-- Campo: Estatus del Proyecto -->
                    <div class="mb-3">
                        <label for="proyecto_status" class="form-label fw-semibold">Estatus</label>
                        <select class="form-select" id="proyecto_status" name="status" required>
                            <option value="planeacion">En Planeación</option>
                            <option value="proceso">En Proceso</option>
                            <option value="terminado">Terminado</option>
                        </select>
                    </div>

                    <!-- Campos: Fechas (Línea doble con el sistema Grid de Bootstrap) -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="start_date" class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="end_date" class="form-label">Fecha de Entrega</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required>
                        </div>
                    </div>

                    <!-- Botones de acción alineados con tu estilo -->
                    <button type="submit" class="btn btn-primary mt-3">Guardar Proyecto</button>
                    <a href="{{ route('cliente.index') }}" class="btn btn-info mt-3">Regresar</a>
                </form>
            </div>
        </div>
    </div>
@endsection