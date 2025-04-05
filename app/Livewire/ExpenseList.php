<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expense;

class ExpenseList extends Component
{
    public $expenses;
    public $categories = [];
    public $selectedCategory = '';
    public $dateFrom = '';
    public $dateTo = '';
    
    public function mount()
    {
        $this->categories = Expense::distinct('category')->pluck('category');
        $this->loadExpenses();
    }
    
    public function loadExpenses()
    {
        $query = Expense::query()
            ->when($this->selectedCategory, fn($q) => $q->where('category', $this->selectedCategory))
            ->when($this->dateFrom, fn($q) => $q->where('date', '>=', $this->dateFrom))
            ->when($this->dateTo, fn($q) => $q->where('date', '<=', $this->dateTo))
            ->orderBy('date', 'desc');
            
        $this->expenses = $query->get();
    }
    public function updated()
    {
        $this->loadExpenses();
    }
    public function editExpense($id)
    {
        return redirect()->route('expenses.edit',['id' => $id]);
    }
    public function deleteExpense($id)
    {
        Expense::find($id)->delete();
        $this->loadExpenses();
    }
    public function render()
    {
        return view('livewire.expense-list');
    }
}
