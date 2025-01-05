<x-app-layout>
<!-- Edit History Form -->
<form action="{{ route('derogatory_record_histories.update', $history->id) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Violation -->
    <div>
        <label for="violation">Violation:</label>
        <input type="text" id="violation" name="violation" value="{{ $history->violation }}">
    </div>

    <!-- Action Taken -->
    <div>
        <label for="action_taken">Action Taken:</label>
        <input type="text" id="action_taken" name="action_taken" value="{{ $history->action_taken }}">
    </div>

    <!-- Sanction -->
    <div>
        <label for="sanction">Sanction:</label>
        <input type="text" id="sanction" name="sanction" value="{{ $history->sanction }}">
    </div>

    <!-- Settled -->
    <div>
        <label for="settled">Settled:</label>
        <select id="settled" name="settled">
            <option value="1" {{ $history->settled ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$history->settled ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Update</button>
</form>
</section>
</x-app-layout>

