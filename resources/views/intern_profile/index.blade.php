<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Profiles') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">
                <!-- Search and Filter Section -->
                <form action="{{ route('intern.index') }}" method="GET" class="flex items-center gap-4">
                    <input 
                        type="text" 
                        name="search" 
                        class="search-input px-4 py-2 rounded-md dark:bg-gray-700"
                        placeholder="Search by student number or name"
                        value="{{ request('search') }}"
                    >
                    
                    <select 
                        name="filter" 
                        class="px-4 py-2 rounded-md dark:bg-gray-700"
                    >
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>All</option>
                        <option value="4th" {{ request('filter') == '4th' ? 'selected' : '' }}>4th Year</option>
                        <option value="graduated" {{ request('filter') == 'graduated' ? 'selected' : '' }}>Graduated</option>
                    </select>

                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
                    >
                        Search
                    </button>

                    <a 
                        href="{{ route('intern.index') }}" 
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600"
                    >
                        Show All Eligible Interns
                    </a>
                </form>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-600">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                STUDENT NUMBER
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                LAST NAME
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                FIRST NAME
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                MIDDLE NAME
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                YEAR LEVEL
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                BATCH NAME/YEAR
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                CIBAT CLASS
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ROSTER NUMBER
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                DOCUMENTS
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                STATUS
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">
                                ACTIONS
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-600">
                        @if(isset($interns) && count($interns) > 0)
                            @foreach($interns as $intern)
                                <tr>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->student_number ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->last_name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->first_name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->middle_name ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->year_level ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->batch_name ?? 'Not Set' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->cibat_class ?? 'Not Set' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        {{ $intern->roster_number ?? 'Not Assigned' }}
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        @if($intern->documents)
                                            @php
                                                $documents = is_string($intern->documents) ? json_decode($intern->documents) : $intern->documents;
                                            @endphp
                                            @if(is_array($documents) || is_object($documents))
                                                @foreach($documents as $document)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-700 dark:text-blue-100 mr-1">
                                                        {{ $document }}
                                                    </span>
                                                @endforeach
                                            @else
                                                <span class="text-gray-500">No documents</span>
                                            @endif
                                        @else
                                            <span class="text-gray-500">No documents</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($intern->status ?? '') === 'Active' ? 'bg-green-100 text-green-800 dark:bg-green-700 dark:text-green-100' : 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-100' }}">
                                            {{ $intern->status ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-sm font-medium">
                                        <a href="{{ route('intern.edit', $intern->student_number) }}" 
                                           class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-300 mr-3">
                                            Edit
                                        </a>
                                        <form action="{{ route('intern.destroy', $intern->student_number) }}" 
                                              method="POST" 
                                              class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" 
                                                    onclick="return confirm('Are you sure you want to delete this record?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No records found
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

<style>
.search-container {
    margin-bottom: 20px;
    display: flex;
    gap: 10px;
}

.search-form {
    display: flex;
    gap: 15px;
    align-items: center;
}

.search-wrapper {
    display: flex;
    gap: 10px;
    position: relative;
}

.search-input {
    padding: 8px 12px;
    border: 2px solid #2d3748;
    border-radius: 6px;
    background-color: #1a202c;
    color: #fff;
    min-width: 250px;
    font-size: 14px;
    transition: all 0.3s ease;
    box-shadow: 0 0 0 rgba(49, 130, 206, 0);
}

.search-input:focus {
    border-color: #3182ce;
    box-shadow: 0 0 10px rgba(49, 130, 206, 0.3);
    transform: translateY(-1px);
    outline: none;
}

.search-input::placeholder {
    color: #718096;
}

.animate {
    animation: fadeIn 0.5s ease-out;
    transition: all 0.3s ease;
}

.search-button, .show-all-btn {
    padding: 8px 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 14px;
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
}

.search-button {
    background-color: #2d3748;
    color: #fff;
}

.show-all-btn {
    background-color: #3182ce;
    color: #fff;
    text-decoration: none;
}

.search-button:hover, .show-all-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

.search-button:hover {
    background-color: #4a5568;
}

.show-all-btn:hover {
    background-color: #2c5282;
}

.search-button:active, .show-all-btn:active {
    transform: translateY(1px);
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
}

/* Ripple effect */
.search-button::after, .show-all-btn::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    transition: width 0.3s ease-out, height 0.3s ease-out;
}

.search-button:active::after, .show-all-btn:active::after {
    width: 200px;
    height: 200px;
    opacity: 0;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Floating animation for buttons */
@keyframes float {
    0% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-2px);
    }
    100% {
        transform: translateY(0px);
    }
}

.search-button:hover, .show-all-btn:hover {
    animation: float 2s ease-in-out infinite;
}
</style>
