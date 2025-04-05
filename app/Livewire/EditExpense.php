<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Expense;

class EditExpense extends Component
{
    public $expenseId;

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

    public function mount($id)
    {
        $expense = Expense::findOrFail($id);
        $this->expenseId = $expense->id;
        $this->amount = $expense->amount;
        $this->category = $expense->category;
        $this->date = $expense->date->format('Y-m-d');
        $this->description = $expense->description;
        $this->is_recurring = $expense->is_recurring;
        $this->recurring_frequency = $expense->recurring_frequency;
    }

    public function update()
    {
        $this->validate();

        $expense = Expense::findOrFail($this->expenseId);

        $expense->update([
            'amount' => $this->amount,
            'category' => $this->category,
            'date' => $this->date,
            'description' => $this->description,
            'is_recurring' => $this->is_recurring,
            'recurring_frequency' => $this->is_recurring ? $this->recurring_frequency : null,
        ]);

        session()->flash('message', 'Expense updated successfully!');
        return redirect()->route('expenses.index');
    }

    public function render()
    {
        return view('livewire.edit-expense', [
            'expense' => Expense::findOrFail($this->expenseId),
        ]);
    }
}
