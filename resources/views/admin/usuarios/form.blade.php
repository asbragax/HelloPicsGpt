<div class="form-group mb-3">
    <label>Nome</label>
    <input type="text" name="name" class="form-control" required value="{{ old('name', $usuario->name ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required value="{{ old('email', $usuario->email ?? '') }}">
</div>

<div class="form-group mb-3">
    <label>Senha</label>
    <input type="password" name="password" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
</div>

<div class="form-group mb-4">
    <label>Confirmar Senha</label>
    <input type="password" name="password_confirmation" class="form-control" {{ isset($usuario) ? '' : 'required' }}>
</div>

<button class="btn btn-primary">Salvar</button>
<a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
