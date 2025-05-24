<div class="form-group mb-3">
    <label>Nome do Pack</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $produto->name ?? '') }}" required>
</div>

<div class="form-group mb-3">
    <label>Tamanho</label>
    <input type="text" name="size" class="form-control" value="{{ old('size', $produto->size ?? '') }}" required>
</div>

<div class="form-group mb-3">
    <label>Quantidade de Fotos</label>
    <input type="number" name="photo_limit" class="form-control" value="{{ old('photo_limit', $produto->photo_limit ?? '') }}" required>
</div>

<div class="form-group mb-3">
    <label>Preço</label>
    <input type="text" name="price" class="form-control" value="{{ old('price', $produto->price ?? '') }}" required>
</div>

<div class="form-check mb-2">
    <input type="checkbox" name="includes_caption" class="form-check-input" value="1"
        {{ old('includes_caption', $produto->includes_caption ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">Permite Legenda</label>
</div>

<div class="form-check mb-2">
    <input type="checkbox" name="includes_mold" class="form-check-input" value="1"
        {{ old('includes_mold', $produto->includes_mold ?? false) ? 'checked' : '' }}>
    <label class="form-check-label">Permite Moldura</label>
</div>

<div class="form-check mb-4">
    <input type="checkbox" name="status" class="form-check-input" value="1"
        {{ old('status', $produto->status ?? true) ? 'checked' : '' }}>
    <label class="form-check-label">Ativo</label>
</div>

<button class="btn btn-primary">Salvar</button>
<a href="{{ route('admin.produtos.index') }}" class="btn btn-secondary">Cancelar</a>
