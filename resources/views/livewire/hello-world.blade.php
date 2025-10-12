<div class="p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">{{ $message }}</h2>
    
    <div class="mb-4">
        <button wire:click="increment">+</button>
            <h1>{{ $count }}</h1>
        <button wire:click="decrement">-</button>
        </div>
    
    <div class="text-sm text-gray-600">
        This is a test Livewire component. If you can see this and the button works, Livewire is successfully installed!
    </div>
</div>
