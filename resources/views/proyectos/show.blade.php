@extends("layout.main")


            @section("contenido")
<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-10">
            
            

            <div class="row g-4">
                <!-- COLUMNA 1: DATOS DEL PROYECTO -->
                <div class="col-12 col-md-7">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body p-4">
                            <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill mb-3 text-capitalize fw-bold">
                                {{ $proyecto->status }}
                            </span>
                            <h3 class="fw-bold text-dark mb-3">{{ $proyecto->name }}</h3>
                            
                            <h6 class="text-secondary fw-bold uppercase small">Descripción</h6>
                            <p class="text-dark bg-light p-3 rounded border fs-5">
                                {{ $proyecto->description }}
                            </p>

                            <div class="row mt-4">
                                <div class="col-6">
                                    <span class="text-secondary d-block small fw-semibold">Fecha de Inicio</span>
                                    <span class="fw-bold text-dark"><i class="bi bi-calendar-event"></i> {{ $proyecto->start_date }}</span>
                                </div>
                                <div class="col-6">
                                    <span class="text-secondary d-block small fw-semibold">Fecha de Entrega</span>
                                    <span class="fw-bold text-dark"><i class="bi bi-calendar-check"></i> {{ $proyecto->end_date }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

      <div class="col-12 col-md-5">
                    <div class="card shadow-sm border-0 bg-light h-100">
                        <div class="card-body p-4">
                            <h4 class="fw-bold text-secondary mb-4">Cliente Asignado</h4>
                            
                            <!-- Accedemos directamente mediante la relación $proyecto->cliente -->
                            @if($proyecto->cliente)
                                <div class="mb-3">
                                    <label class="text-muted small d-block">Nombre del Contacto</label>
                                    <span class="fs-5 fw-bold text-dark">{{ $proyecto->cliente->name }}</span>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted small d-block">Correo Electrónico</label>
                                    <span class="text-dark">{{ $proyecto->cliente->email }}</span>
                                </div>

                                <div class="mb-3">
                                    <label class="text-muted small d-block">Teléfono</label>
                                    <span class="text-dark">{{ $proyecto->cliente->phone }}</span>
                                </div>

                                <div>
                                    <label class="text-muted small d-block">Estatus del Cliente</label>
                                    <span class="badge {{ $proyecto->cliente->status == 'activo' ? 'bg-success' : 'bg-danger' }}">
                                        {{ $proyecto->cliente->status }}
                                    </span>
                                </div>
                            @else
                                <p class="text-danger">Este proyecto no tiene un cliente válido asignado.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    <hr>
           
      
   

     

        <!-- CRUD DE TAREAS ASOCIADAS -->
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="fw-bold m-0 text-secondary">Tareas del Proyecto</h4>
                    <!-- Botón que activa el Modal de Crear Tarea -->
                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#modalCrearTarea">
                        + Nueva Tarea
                    </button>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Tarea</th>
                                     <th>Descripción</th>
                                    <th>Prioridad</th>
                                    <th>Estado</th>
                                    <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($proyecto->tareas as $tarea)
                                    <tr>
                                        <td class="fw-semibold">{{ $tarea->name }}</td>
                                         <td class="fw-semibold">{{ $tarea->description }}</td>
                                        <td>
                                            <!-- Color de la prioridad -->
                                            <span class="badge {{ $tarea->priority == 'alta' ? 'bg-danger' : ($tarea->priority == 'media' ? 'bg-warning text-dark' : 'bg-secondary') }}">
                                                {{ $tarea->priority }}
                                            </span>
                                        </td>
                                        <td>
                                            <!-- Color del estado -->
                                            <span class="badge {{ $tarea->status == 'terminada' ? 'bg-success' : 'bg-dark' }}">
                                                {{ $tarea->status }}
                                            </span>
                                        </td>
                                        <td class="fw-semibold">{{ $tarea->due_date }}</td>
                                        <td class="text-center">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <!-- Botón Editar (Pasa los datos al JS mediante atributos data-*) -->
                                                <button class="btn btn-sm btn-warning btn-editar-tarea" 
        data-bs-toggle="modal" 
        data-bs-target="#modalEditarTarea"
        data-bs-id="{{ $tarea->id }}"
        data-bs-name="{{ $tarea->name }}"
        data-bs-description="{{ $tarea->description }}"
        data-bs-status="{{ $tarea->status }}"
        data-bs-priority="{{ $tarea->priority }}"
        data-bs-duedate="{{ $tarea->due_date }}">
    Editar
</button>

                                                <form action="{{ route('tarea.destroy', $tarea->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar tarea?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted">No hay tareas creadas para este proyecto aún.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

          <hr>
                <form action="{{ route("proyecto.destroy", $proyecto->id)}}" method="post"
                            @csrf
                            @method("delete")
                            <button class="btn btn-danger">Eliminar</button>
                            
                            </form> 
                <a href="{{ route('cliente.index') }}" class="btn btn-info px-4 border mt-3">
                                    Regresar
                                </a>
    </div>
</div>
<!-- ================= MODAL: CREAR TAREA ================= -->
<div class="modal fade" id="modalCrearTarea" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Agregar Nueva Tarea</h5>
                <button type="button" class="btn-close" data-bs-with="modal" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('tarea.store') }}" method="POST">
                @csrf
                <input type="hidden" name="proyect_id" value="{{ $proyecto->id }}">
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nombre de la tarea</label>
                        <input type="text" name="name" class="form-control" required placeholder="Ej. Definir base de datos">
                    </div>
                      
                    <div class="mb-3">
                        <label class="form-label">Descripción de la tarea</label>
                        <input type="text" name="description" class="form-control" required placeholder="Ej. Diseñar base de datos">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Prioridad</label>
                        <select name="priority" class="form-select" required>
                            <option value="baja">Baja</option>
                            <option value="media">Media</option>
                            <option value="alta">Alta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Estado Inicial</label>
                        <select name="status" class="form-select" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="en_proceso">En Proceso</option>
                            <option value="terminada">Terminada</option>
                        </select>
                    </div>
                     <div class="col-md-6 mb-3">
                                    <label for="end_date" class="form-label fw-semibold">Fecha de Entrega</label>
                                    <input type="date" class="form-control" id="end_date" name="due_date" 
                                           value="{{ old('due_date', $proyecto->due_date) }}" required>
                                </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Guardar Tarea</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- ================= MODAL: EDITAR TAREA ================= -->
<div class="modal fade" id="modalEditarTarea" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Modificar Tarea</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form id="formEditarTarea" method="POST">
                @csrf
                @method('PUT')
                
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_nombre" class="form-label">Nombre de la tarea</label>
                        <input type="text" name="name" id="edit_nombre" class="form-control" required placeholder="Ej. Definir base de datos">
                    </div>
                      
                    <div class="mb-3">
                        <label  for="edit_description" class="form-label">Descripción de la tarea</label>
                        <input type="text" name="description" id="edit_description"class="form-control" required placeholder="Ej. Diseñar base de datos">
                    </div>
                    <div class="mb-3">
                        <label for="edit_priority" class="form-label">Prioridad</label>
                        <select id="edit_priority" name="priority" class="form-select" required>
                            <option value="baja">Baja</option>
                            <option value="media">Media</option>
                            <option value="alta">Alta</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status" class="form-label">Estado</label>
                        <select id="edit_status" name="status" class="form-select" required>
                            <option value="pendiente">Pendiente</option>
                            <option value="en_proceso">En Proceso</option>
                            <option value="terminada">Terminada</option>
                        </select>
                    </div>
                     <div class="mb-3">
                        <label for="edit_fecha" class="form-label fw-semibold">Fecha de Entrega</label>
                        <input type="date" class="form-control" id="edit_fecha" name="due_date" required>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                   
                    <button type="submit" class="btn btn-primary fw-bold">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- SCRIPT JS PARA PASAR LOS DATOS AL MODAL DE EDICIÓN AUTOMÁTICAMENTE -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const modalEditarTarea = document.getElementById('modalEditarTarea');
    
    if (modalEditarTarea) {
        modalEditarTarea.addEventListener('show.bs.modal', function (event) {
            // El botón exacto que el usuario presionó
            const boton = event.relatedTarget;
            
            // Extraer los datos usando los nuevos prefijos data-bs-*
            const id = boton.getAttribute('data-bs-id');
            const name = boton.getAttribute('data-bs-name');
            const description = boton.getAttribute('data-bs-description');
            const status = boton.getAttribute('data-bs-status');
            const priority = boton.getAttribute('data-bs-priority');
            const dueDate = boton.getAttribute('data-bs-duedate');
            
            // Rellenar los campos del modal de forma segura
            modalEditarTarea.querySelector('#edit_nombre').value = name || '';
            modalEditarTarea.querySelector('#edit_description').value = description || '';
            modalEditarTarea.querySelector('#edit_priority').value = priority || '';
            modalEditarTarea.querySelector('#edit_status').value = status || '';
            
            // Forzar el llenado de la fecha (asegúrate de que el input del modal tenga id="edit_fecha")
            const inputFecha = modalEditarTarea.querySelector('#edit_fecha');
            if (inputFecha) {
                inputFecha.value = dueDate || '';
            }
            
            // Cambiar la ruta de envío del formulario
            const form = modalEditarTarea.querySelector('#formEditarTarea');
            if (form) {
                form.action = `/tarea/${id}`;
            }
        });
    }
});
</script>





              
        </div>
    </div>
</div>
@endsection