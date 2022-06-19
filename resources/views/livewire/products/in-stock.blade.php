<div class="m-2 toggle colour">
  @hasrole('seller|super-admin')
    <input wire:model="in_stock" type="checkbox" name="toggle" id="{{ $name.$product->id }}"
          class="hidden toggle-checkbox">
    <label for="{{ $name.$product->id }}" class="block w-12 h-6 duration-150 ease-out rounded-full curso-pointer transition-color toggle-label"></label>
  @endhasrole

  @role('admin')
    @if($product->in_stock)
          Yes
    @else
          No
    @endif
  @endrole
</div>