<div class="col-md-12 mt-1">
  <input type="file" class="sombra form-control "  name="file" accept=".xlsx" data-button="Cargar excel " data-empty="Sin archivos" required/>
  @error('file')
  <div class="error text-center">{{ $message }}</div>
  @enderror
</div>
