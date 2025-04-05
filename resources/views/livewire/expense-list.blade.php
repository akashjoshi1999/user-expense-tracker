<!-- resources/views/livewire/expense-list.blade.php -->
<div>
    <!-- Success/Error Messages -->
    @if(session('message'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('message') }}
        </div>
    @endif
    
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Filters -->
    <div class="flex gap-4 mb-4">
        <select wire:model="selectedCategory" class="border rounded p-2">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category }}">{{ $category }}</option>
            @endforeach
        </select>
        
        <input type="date" wire:model="dateFrom" placeholder="From date">
        <input type="date" wire:model="dateTo" placeholder="To date">
    </div>
    
    <!-- Expenses Table -->
    <table class="w-full">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-2 text-left">Date</th>
                <th class="px-4 py-2 text-left">Category</th>
                <th class="px-4 py-2 text-left">Amount</th>
                <th class="px-4 py-2 text-left">Description</th>
                <th class="px-4 py-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($expenses as $expense)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $expense->date->format('Y-m-d') }}</td>
                    <td class="px-4 py-2">{{ $expense->category }}</td>
                    <td class="px-4 py-2">${{ number_format($expense->amount, 2) }}</td>
                    <td class="px-4 py-2">{{ $expense->description }}</td>
                    <td class="px-4 py-2">
                        <div class="row">
                            <div>
                                <button 
                                    wire:click="editExpense({{ $expense->id }})"                                    
                                    class="text-red-600 hover:text-red-900 hover:bg-red-50 px-2 py-1 rounded"
                                >
                                    Edit
                                </button>
                            </div>
                            <div class="">
                                <button 
                                    wire:click="deleteExpense({{ $expense->id }})"
                                    wire:confirm="Are you sure you want to delete this expense?"
                                    class="text-red-600 hover:text-red-900 hover:bg-red-50 px-2 py-1 rounded"
                                >
                                    Delete
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
