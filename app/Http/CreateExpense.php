<?php

// app/Http/Livewire/CreateExpense.php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Expense;

class CreateExpense extends Component
{
    public $amount;
    public $category;
    public $date;
    public $description;
    public $is_recurring = false;
    public $recurring_frequency;
    
    protected $rules = [
        'amount' => 'required|numeric|min:0.01',
        'category' => 'required|string',
        'date' => 'required|date',
        'description' => 'nullable|string',
        'is_recurring' => 'boolean',
        'recurring_frequency' => 'nullable|in:daily,weekly,monthly,yearly'
    ];
    
    public function save()
    {
        $this->validate();
        
        Expense::create([
            'amount' => $this->amount,
            'category' => $this->category,
            'date' => $this->date,
            'description' => $this->description,
            'is_recurring' => $this->is_recurring,
            'recurring_frequency' => $this->is_recurring ? $this->recurring_frequency : null,
            'user_id' => auth()->id()
        ]);
        
        $this->reset();
        session()->flash('message', 'Expense added successfully!');
    }
    
    public function render()
    {
        return view('livewire.create-expense');
    }
}
