<!-- resources/views/livewire/expense-page.blade.php -->
<div>
    <h1 class="text-2xl font-bold mb-6">My Expenses</h1>
    
    <div class="mb-8">
        <a href="{{ route('expenses.create') }}">
            <h2 class="text-xl font-semibold mb-4">Add New Expense</h2>
        </a>
        
    </div>
    
    <div>
        <h2 class="text-xl font-semibold mb-4">Expense List</h2>
        @livewire('expense-list')
    </div>
</div>