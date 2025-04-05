<!-- resources/views/livewire/create-expense.blade.php -->
<div>
    @if(session('message'))
        <div class="bg-green-100 p-4 mb-4">
            {{ session('message') }}
        </div>
    @endif
    
    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label>Amount</label>
            <input type="number" wire:model="amount" step="0.01" class="border rounded p-2 w-full" value="{{ $expense->amount }}">
            @error('amount') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-4">
            <label>Category</label>
            <select wire:model="category" class="border rounded p-2 w-full">
                <option value="">Select Category</option>
                <option value="Food">Food</option>
                <option value="Travel">Travel</option>
                <option value="Bills">Bills</option>
                <option value="Entertainment">Entertainment</option>
            </select>
            @error('category') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-4">
            <label>Date</label>
            <input type="date" wire:model="date" class="border rounded p-2 w-full" value="{{ $expense->date->format('Y-m-d') }}">
            @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        
        <div class="mb-4">
            <label>Description</label>
            <textarea wire:model="description" class="border rounded p-2 w-full" value="{{ $expense->description }}"></textarea>
        </div>
        
        <div class="mb-4">
            <label class="flex items-center">
                <input type="checkbox" wire:model="is_recurring" class="mr-2" {{ $expense->is_recurring ? 'checked' : '' }}>
                Recurring Expense?
            </label>
        </div>
        
        @if($is_recurring)
            <div class="mb-4">
                <label>Frequency</label>
                <select wire:model="recurring_frequency" class="border rounded p-2 w-full">
                    <option value="daily">Daily</option>
                    <option value="weekly">Weekly</option>
                    <option value="monthly">Monthly</option>
                    <option value="yearly">Yearly</option>
                </select>
            </div>
        @endif
        
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Update Expense</button>
    </form>
</div>