<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\cliente;
use Livewire\WithPagination;

class ClientesController extends Component
{
    use WithPagination;
    public $nombre, $apellidos, $ci, $correo, $pageTitle, $componentName, $search;
    private $pagination = 1;

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
}
