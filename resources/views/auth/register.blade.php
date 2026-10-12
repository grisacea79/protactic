@extends("layout.main")

@section("contenido")

<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5">
            <div class="card shadow border-0 rounded-3 my-4">
                <div class="card-header bg-success text-white text-center py-3 rounded-top">
                    <h4 class="m-0 fw-bold">Crear Cuenta</h4>
                </div>
                <div class="card-body p-4">
                    
                    <!-- Laravel Validation Errors -->
                    @if ($errors->any())
                        <div class="alert alert-danger py-2 small">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold">Nombre Completo</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required autofocus placeholder="Ej. Juan Pérez">
                        </div>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="email" class="form-label fw-semibold">Correo Electrónico</label>
                            <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required placeholder="ejemplo@correo.com">
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-semibold">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control" required placeholder="Mínimo 8 caracteres">
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label fw-semibold">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required placeholder="Repite tu contraseña">
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-success fw-bold py-2 shadow-sm">
                                Registrarse e Ingresar
                            </button>
                        </div>
                        
                        <div class="text-center mt-3">
                            <a href="{{ route('login') }}" class="text-decoration-none small text-secondary">¿Ya tienes una cuenta? Inicia sesión</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection