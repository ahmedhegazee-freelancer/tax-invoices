<div>
    <form wire:submit.prevent="upload">

        <input type="file" wire:model="file">
        @error('file')
            <span class="error">{{ $message }}</span>
        @enderror
        <select wire:model="fileType">
            <option value="tickets">Tickets</option>
            <option value="items">Tickets Items</option>
        </select>
        @error('fileType')
            <span class="error">{{ $message }}</span>
        @enderror
        <button type="submit">Upload</button>
    </form>
</div>
