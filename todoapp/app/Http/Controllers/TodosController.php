<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
class TodosController extends Controller
{
   public function index(){
    // $todos= Todo::all();
       return view("todos.index")->with('todos', Todo::all());
   }
   public function show(Todo $todo){
 
      // $todo = Todo::find($todoId);
      return view('todos.show')->with('todo', $todo);
   }
   public function create(){
 
      
      return view('todos.create');
   }
   public function store(){   
      
      $this->validate(request(),[
         'name' => 'required|min:6|max:20',
         'description'=>'required'
      ]);
      // dd(request()->all());
      $data = request()->all();
      $todo = new Todo();
      $todo->name = $data['name'];
      $todo->description = $data['description'];
      $todo->completed = false;
      $todo->save();
      session()->flash("success", "Todo created.");
      return redirect('/todos');


   }
   public function edit(Todo $todo){
          return view('todos.edit')->with('todo', $todo);
   }
   public function update(Todo $todo){
      $this->validate(request(),[
         'name' => 'required|min:6|max:20',
         'description'=>'required'
      ]);
      $data = request()->all();
      $todo->name = $data['name'];
      $todo->description = $data['description'];
      $todo->save();
      session()->flash("success", "Todo updated.");
      return redirect('/todos');

   }
   public function destroy(Todo $todo){
      $todo->delete();
      session()->flash("success", "Todo deleted.");
      return redirect('/todos');

   }
   public function complete(Todo $todo){
      $todo-> completed = true;
      $todo-> save();
      session()->flash("success", "Good Job");
      return redirect('/todos');

   }
}


