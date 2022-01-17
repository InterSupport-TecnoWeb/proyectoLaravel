@include('common.modalHead')

<div class="row">
    <div class="col-sm-12 col-md-8">
        <div class="form-group">
            <label> Nombre:</label>
            <input type="text" wire:modal.lazy="nombre" class="form-control" placeholder="ej: Example">
            @error('nombre') <span class="text danger er">{{$mensage}}</span> @enderror
        </div>
    </div>


    <div class="col-sm-12">
        <label>Apellidos</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:modal.lazy="apellidos" class="form-control" placeholder="ej: Example Apllido">
        </div>
        @error('apellidos') <span class="text danger er">{{$mensage}}</span> @enderror
    </div>

    C.I.:
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:modal.lazy="ci" class="form-control" placeholder="ej: 9589151">
        </div>
        @error('ci') <span class="text danger er">{{$mensage}}</span> @enderror
    </div>

    Correo:
    <div class="col-sm-12">
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text">
                    <span class="fas fa-edit">

                    </span>
                </span>
            </div>
            <input type="text" wire:modal.lazy="correo" class="form-control" placeholder="ej: Example@gmail.com">
        </div>
        @error('correo') <span class="text danger er">{{$mensage}}</span> @enderror
    </div>

</div>


@include('common.modalFooter')
