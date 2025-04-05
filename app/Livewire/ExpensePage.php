<?php

namespace App\Livewire;

use Livewire\Component;

class ExpensePage extends Component
{
    public function render()
    {
        return view('livewire.expense-page');
    }
    public function delete($id)
    {
        $expense = Expense::findOrFail($id);
        
        // Optional: Add authorization check
        if ($expense->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }
        
        $expense->delete();
        $this->loadExpenses(); // Refresh the list
        
        // Optional: Add flash message
        session()->flash('message', 'Expense deleted successfully');
    }
}
