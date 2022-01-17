@include('common.modalHead')

<div class="row">
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:modal.lazy="nombre" class="form-control" placeholder="ej: cursos">
        </div>
        @error('nombre') <span class="text danger er">{{$mensage}}</span> @enderror
    </div>

    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:modal.lazy="nombre" class="form-control" placeholder="">
        </div>
        @error('nombre') <span class="text danger er">{{$mensage}}</span> @enderror
    </div>


</div>


@include('common.modalFooter')
