<?php

namespace App\Http\Livewire;

use App\Models\categoria;
use App\Models\cliente;
use Livewire\Component;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;
    public $nombre, $search, $apellidos, $ci, $correo, $selected_id, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Clientes';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        if(strlen($this->search) > 0){
            $data = cliente::where('nombre', 'like', '%' . $this->search . '%')->paginate($this->pagination);
        }else{
            $data = cliente::orderBy('id', 'desc')->paginate($this->pagination);
        }

        return view('livewire.cliente.clientes', ['clientes' => $data])
            ->extends('layouts.theme.app')
            ->section('content');
    }

    public function Edit($id){
        $record = cliente::find($id, ['id', 'nombre', 'apellidos', 'ci', 'correo']);
        $this->nombre = $record->nombre;
        $this->apellidos = $record->apellidos;
        $this->ci = $record->ci;
        $this->correo = $record->correo;
        $this->selected_id = $record->id;

        $this->emit('show-modal', 'show  modal!');
    }

    public function Store(){
        $rules = [
            'nombre' => 'required',
        ];

        $messages = [
            'nombre.required' => 'Nombre de la categoria es requerido',
        ];

        $this->validate($rules, $messages);

        $categoria = cliente::create([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'ci'=> $this->ci,
            'correo'=> $this->correo
        ]);

        $categoria->save();
        $this->resetUI();
        $this->emit('cliente-added', 'Cliente Registrada!');
    }

    public function Update(){
        $rules = [
            'nombre' => 'required | min:3',
        ];

        $messages = [
            'nombre.required' => 'Nombre de la categoria es requerido',
        ];

        $this->validate($rules, $messages);

        $categoria = cliente::find($this->selected_id);
        $categoria->update([
            'nombre' => $this->nombre,
            'apellidos' => $this->apellidos,
            'ci'=> $this->ci,
            'correo'=> $this->correo
        ]);

        $categoria->save();
        $this->resetUI();
        $this->emit('cliente-updated', 'Cliente actualizada!');
    }

    public function resetUI(){
        $this->nombre = '';
        $this->apellidos = '';
        $this->ci = '';
        $this->correo = '';
        $this->selected_id = 0;
    }

    protected $listeners = [
        'deleteRow' => 'Destroy'
    ];

    public function Destroy($id){
        $categoria = cliente::find($id);
        /* dd($categoria); */
        $categoria->delete();
        $this->resetUI();
        $this->emit('categoria-deleted', 'Categoria eliminada');
    }
}
