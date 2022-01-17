<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\cliente;
use Livewire\WithPagination;

class Clientes extends Component
{
    use WithPagination;

    public $nombre, $apellidos, $ci, $correo, $pageTitle, $componentName, $search, $selected_id;
    private $pagination = 4;

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
        if (strlen($this->search)>0){
            $data = cliente::where('nombre','like','%'.$this->search.'%')->paginate($this->pagination);
        }else{
            $data = cliente::orderBy('id','desc')->paginate($this->pagination);
        }
        return view('livewire.cliente.clientes',['clientes'=>$data])
        ->extends('layouts.theme.app')
        ->section('content');
    }

    public function Edit($id){
        $record = cliente::find($id,['id','nombre','apellidos','ci','correo']);
        $this->nombre = $record->nombre;
        $this->selected_id = $record->id;
        $this->apellidos = $record->apllidos;
        $this->ci = $record->ci;
        $this->correo = $record->correo;
        $this->emit('show-modal','show modal!');
    }

    public function Store(){
        /*$rules = [
            'nombre'=> 'required',
            'apellidos'=>'required',
            'ci'=>'required',
            'correo'=>'required'
        ];
        $message = [
            'nombre.required'=>'Nombre del cliente es requerido',
            'apellidos.required'=>'Apellidos del cliente es requerido',
            'ci'=>'Carnet de Identidad del cliente es requerido',
            'correo'=>'Correo del cliente es requerido'
        ];
        $this->validate($rules,$message);*/
        dd($this->nombre);
        $cliente = cliente::create([
            'nombre'=>$this->nombre,
            'apellidos'=>$this->apellidos,
            'ci'=>$this->ci,
            'correo'=>$this->correo
        ]);
        $cliente->save();
        $this->resetUI();
        $this->emit('cliente-added','Cliente Registrado');
    }

    public function Update(){
        $rules = [
            'nombre'=> 'required',
            'apellidos'=>'required',
            'ci'=>'required',
            'correo'=>'required'
        ];
        $message = [
            'nombre.required'=>'Nombre del cliente es requerido',
            'apellidos.required'=>'Apellidos del cliente es requerido',
            'ci'=>'Carnet de Identidad del cliente es requerido',
            'correo'=>'Correo del cliente es requerido'
        ];
        $this->validate($rules,$message);

        $cliente = cliente::find($this->selected_id);
        $cliente->update([
            'nombre'=>$this->nombre,
            'apellidos'=>$this->apellidos,
            'ci'=>$this->ci,
            'correo'=>$this->correo
        ]);
        $cliente->save();

        $this->resetUI();
        $this->emit('cliente-updated','Cliente Actualizado');
    }

    public function resetUI(){
        $this->nombre='';
        $this->apellidos='';
        $this->ci='';
        $this->search='';
        $this->selected_id=0;
    }

    protected $listeners = [
        'deleteRow'=> 'Destroy'
    ];

    public function Destroy(cliente $cliente){
        //$cliente = cliente::find($id);
        dd($cliente);
        $cliente->delete();

        $this->resetUI();
        $this->emit('cliente-deleted','Cliente eliminado');
    }
}
