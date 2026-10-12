@extends("layout.main")

@section("contenido")
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12">
   @auth
    <!-- Contenedor que empuja todo hacia la derecha -->
    <div class="d-flex justify-content-end mb-3">
        <div class="dropdown">
            <button class="btn btn-white border bg-white dropdown-toggle d-flex align-items-center gap-2 shadow-sm rounded-pill px-3" type="button" id="userMenuRight" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- Círculo con la inicial del nombre -->
                <span class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center fw-bold" style="width: 28px; height: 28px; font-size: 13px;">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </span>
                <span class="fw-semibold text-secondary small">{{ auth()->user()->name }}</span>
            </button>
            <!-- dropdown-menu-end asegura que el menú se despliegue alineado a la derecha del botón -->
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userMenuRight">
                <li>
                    <span class="dropdown-item-text text-muted small text-truncate d-block" style="max-width: 200px;">
                        {{ auth()->user()->email }}
                    </span>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger fw-bold small">
                            🚪 Cerrar Sesión
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
@endauth
            <!-- MENÚ DE 3 OPCIONES (Botones superiores) -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-2">
                    <ul class="nav nav-pills nav-fill gap-2" id="menuDinamico" role="tablist">
                        
                        <!-- Opción 1: Clientes (Activa por defecto) -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active fw-semibold py-3" id="clientes-tab" data-bs-toggle="tab" data-bs-target="#contenido-clientes" type="button" role="tab" aria-controls="contenido-clientes" aria-selected="true">
                                Clientes
                            </button>
                        </li>
                        
                        <!-- Opción 2: Proyectos -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-semibold py-3" id="proyectos-tab" data-bs-toggle="tab" data-bs-target="#contenido-proyectos" type="button" role="tab" aria-controls="contenido-proyectos" aria-selected="false">
                                Proyectos
                            </button>
                        </li>
                        
                        <!-- Opción 3: Tareas -->
                        <li class="nav-item" role="presentation">
                            <button class="nav-link fw-semibold py-3" id="tareas-tab" data-bs-toggle="tab" data-bs-target="#contenido-tareas" type="button" role="tab" aria-controls="contenido-tareas" aria-selected="false">
                                Dashboard
                            </button>
                        </li>
                        
                    </ul>
                </div>
            </div>

           <!-- CONTENEDOR PRINCIPAL QUE SE ACTUALIZA -->
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-body p-4">
                    
                    <div class="tab-content" id="contenedorDinamico">
                        
                        <!-- Contenedor 1: Aquí metemos tu tabla de clientes original -->
                        <div class="tab-pane fade show active" id="contenido-clientes" role="tabpanel" aria-labelledby="clientes-tab" tabindex="0">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h2 class="fw-bold text-dark m-0">Mi CRUD de Clientes</h2>
                                <a href="{{ route('cliente.create') }}" class="btn btn-primary shadow-sm">
                                    Agregar nuevo cliente
                                </a>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Teléfono</th>
                                            <th>Estatus</th>
                                            <th class="text-center" style="width: 150px;">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clientes as $item)
                                            <tr>
                                                <td class="fw-semibold">{{ $item->name }}</td>
                                                <td>{{ $item->email }}</td>
                                                <td>{{ $item->phone }}</td>
                                                <td>
                                                    <span class="badge {{ $item->status == 'activo' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ $item->status }}
                                                    </span>
                                                </td>
 <td>
                                                    <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ route('cliente.edit', $item->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                                       <a href="{{ route('cliente.show', $item->id) }}" class="btn btn-sm btn-outline-danger">Eliminar</a>
                                                       
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Contenedor 2: Contenido de Proyectos -->
                        <div class="tab-pane fade" id="contenido-proyectos" role="tabpanel" aria-labelledby="proyectos-tab" tabindex="0">
                             <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="h3 m-0">Listado de Proyectos</h2>
                <a href="{{ route('proyecto.create') }}" class="btn btn-primary">Agregar nuevo proyecto</a>
            </div>
            <hr>
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
    <hr>
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Proyecto</th>
                        <th>Cliente Responsable</th>
                        <th>Estatus</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Entrega</th>
                         <th class="text-center" style="width: 150px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientes as $cliente)
                        @foreach ($cliente->proyectos as $proyecto)
                            <tr>
                                <td>{{ $proyecto->name }}</td>
                                <!-- Gracias a belongsTo() obtenemos el nombre del cliente relacionado -->
                                <td><span class="fw-bold text-secondary">{{ $cliente->name }}</span></td>
                                <td>
                                    <span class="badge bg-info text-dark text-capitalize">{{ $proyecto->status }}</span>
                                </td>
                                <td>{{ $proyecto->start_date }}</td>
                                <td>{{ $proyecto->end_date }}</td>
                                <td>
                                     <div class="d-flex gap-2 justify-content-center">
                                                        <a href="{{ route('proyecto.edit', $proyecto->id) }}" class="btn btn-sm btn-outline-warning">Editar</a>
                                                        <a href="{{ route('proyecto.show', $proyecto->id) }}" class="btn btn-sm btn-outline-info">Detalle</a>
                                                        
                                                    </div>
                                </td>
                            </tr>
                            
                        @endforeach
                        
                    @endforeach
                </tbody>
            </table>
                       
                       
                        </div>
                        
                        <!-- Contenedor 3: Contenido de Tareas -->
                        <div class="tab-pane fade" id="contenido-tareas" role="tabpanel" aria-labelledby="tareas-tab" tabindex="0">
                           <div class="container my-4">
    <h2 class="fw-bold text-secondary mb-4">Tablero de Control</h2>
    
    <div class="row g-3">
        <!-- Tarjeta: Total Proyectos -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-primary border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fw-semibold small mb-1">Total Proyectos</p>
                        <h3 class="fw-bold m-0 text-dark">{{ $totalProyectos }}</h3>
                    </div>
                    <div class="bg-primary bg-opacity-10 text-primary rounded p-3">
                        <!-- Icono representativo (puedes usar FontAwesome o Bootstrap Icons) -->
                        <i class="fs-3 bi bi-folder">📁</i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Proyectos Terminados -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-success border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fw-semibold small mb-1">Proyectos Terminados</p>
                        <h3 class="fw-bold m-0 text-success">{{ $proyectosTerminados }}</h3>
                    </div>
                    <div class="bg-success bg-opacity-10 text-success rounded p-3">
                        <i class="fs-3 bi bi-check-circle">✅</i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tarjeta: Tareas Vencidas -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-danger border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fw-semibold small mb-1">Tareas Vencidas</p>
                        <h3 class="fw-bold m-0 text-danger">{{ $tareasVencidas }}</h3>
                    </div>
                    <div class="bg-danger bg-opacity-10 text-danger rounded p-3">
                        <i class="fs-3 bi bi-exclamation-triangle">⚠️</i>
                    </div>
                </div>
            </div>
        </div>
                 
                <!-- Tarjeta: Tareas pendientes -->
        <div class="col-md-3">
            <div class="card shadow-sm border-0 border-start border-danger border-4 h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted text-uppercase fw-semibold small mb-1">Tareas Pendientes</p>
                        <h3 class="fw-bold m-0 text-info">{{ $tareasPendientes }}</h3>
                    </div>
                    <div class="bg-warning bg-opacity-10 text-warning rounded p-3">
                       <i class="fs-3 bi bi-clock">⏳</i>
                    </div>
                </div>
            </div>
        </div>
                        </div>
                        
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection