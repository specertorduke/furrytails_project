@extends('main')

@section('title', 'History')

@section('content')
<div class="tw-p-6 tw-h-screen tw-overflow-y-auto tw-bg-[#f4fbfd]">
    <!-- Header -->
    <div class="tw-flex tw-justify-between tw-items-center tw-mb-6">
        <div>
            <!-- <p class="tw-text-sm tw-text-gray-500">Pages / History</p> -->
            <h1 class="tw-text-2xl tw-font-bold">History</h1>
        </div>
        <div class="tw-flex tw-items-center tw-gap-4">
            <!-- User Profile -->
            <div class="tw-flex tw-items-center tw-justify-end tw-bg-white tw-py-1 tw-px-4 tw-rounded-full tw-shadow-md tw-gap-4 tw-transition-all tw-duration-300 tw-ease-in-out hover:tw-shadow-lg">
                <span class="tw-text-gray-700 tw-font-medium">{{ Auth::user()->firstName }} {{ Auth::user()->lastName }}</span>
                <div class="tw-relative">
                    <img src="{{ asset('storage/' . Auth::user()->userImage) }}" alt="User Avatar" 
                        class="tw-w-10 tw-h-10 tw-rounded-full tw-cursor-pointer tw-transition-all tw-duration-300 hover:tw-brightness-75 tw-object-cover" 
                        onclick="toggleDropdown()">
                    <div id="dropdown" class="tw-absolute tw-rounded-3xl tw-right-0 tw-mt-2 tw-w-48 tw-bg-white tw-rounded-md tw-shadow-lg tw-hidden">
                        <a href="{{ route('content.account') }}" class="tw-block tw-px-4 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-100">Account Settings</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="tw-block tw-w-full tw-text-left tw-px-4 tw-py-2 tw-text-gray-700 hover:tw-bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="tw-bg-white tw-rounded-2xl tw-p-4 tw-mb-6 tw-shadow-sm">
        <div class="row tw-items-center">
            <div class="col-12 col-md-4 tw-mb-3 tw-mb-md-0">
                <input type="text" id="searchHistory" placeholder="Search history..." 
                    class="tw-w-full tw-px-4 tw-py-2 tw-rounded-xl tw-border tw-border-gray-200 focus:tw-border-[#24CFF4] focus:tw-ring-1 focus:tw-ring-[#24CFF4]">
            </div>
            <div class="col-12 col-md-8">
                <div class="tw-flex tw-flex-wrap tw-gap-2">
                    <button class="tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-font-medium tw-transition-all type-filter active tw-bg-[#24CFF4] tw-text-white"
                            data-type="all">All</button>
                    <button class="tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-font-medium tw-transition-all type-filter tw-text-gray-500 hover:tw-bg-gray-100"
                            data-type="appointment">Appointments</button>
                    <button class="tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-font-medium tw-transition-all type-filter tw-text-gray-500 hover:tw-bg-gray-100"
                            data-type="boarding">Boarding</button>
                    <button class="tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-font-medium tw-transition-all type-filter tw-text-gray-500 hover:tw-bg-gray-100"
                            data-type="Completed">Completed</button>
                    <button class="tw-px-4 tw-py-2 tw-rounded-xl tw-text-sm tw-font-medium tw-transition-all type-filter tw-text-gray-500 hover:tw-bg-gray-100"
                            data-type="Cancelled">Cancelled</button>
                </div>
            </div>
        </div>
    </div>

    <!-- History Timeline -->
    <div class="tw-space-y-4" id="historyTimeline">
        @php
            $currentMonth = '';
        @endphp

        @forelse($history as $index => $item)
            @php
                $itemDate = $item->type === 'appointment' ? 
                    Carbon\Carbon::parse($item->date) : 
                    Carbon\Carbon::parse($item->start_date);
                $monthYear = $itemDate->format('F Y');
            @endphp

            @if($currentMonth !== $monthYear)
                <div class="month-header tw-flex tw-items-center tw-gap-4 tw-my-6" data-month="{{ $monthYear }}" data-index="{{ $index }}">
                    <span class="tw-text-lg tw-font-semibold tw-text-gray-700">{{ $monthYear }}</span>
                    <div class="tw-flex-1 tw-h-px tw-bg-gray-200"></div>
                </div>
                @php
                    $currentMonth = $monthYear;
                @endphp
            @endif
            <div class="history-item tw-bg-white tw-rounded-2xl tw-p-4 tw-shadow-sm tw-transition-all tw-duration-300 hover:tw-shadow-md hover:tw-scale-[1.01]" 
            data-type="{{ $item->type }}" 
            data-status="{{ $item->status }}" 
            data-month="{{ $monthYear }}" 
            data-index="{{ $index }}">
                <div class="tw-flex tw-items-start tw-gap-4">
                    <!-- Left side: Icon -->
                    <div class="tw-rounded-full tw-p-3 {{ $item->type === 'appointment' ? 'tw-bg-blue-100' : 'tw-bg-green-100' }}">
                        <i class="fas {{ $item->type === 'appointment' ? 'fa-calendar-check' : 'fa-house' }} 
                            {{ $item->type === 'appointment' ? 'tw-text-blue-500' : 'tw-text-green-500' }} tw-text-xl"></i>
                    </div>
                    <!-- Middle: Details -->
                    <div class="tw-flex-grow">
                        <div class="tw-flex tw-justify-between tw-items-start">
                            <div>
                                <h3 class="tw-font-semibold tw-text-lg">{{ $item->serviceName }}</h3>
                                <p class="tw-text-sm tw-text-gray-600">{{ $item->petName }}</p>
                            </div>
                            <span class="tw-px-3 tw-py-1 tw-rounded-full tw-text-sm 
                                {{ $item->status === 'Completed' ? 'tw-bg-green-100 tw-text-green-800' : 
                                ($item->status === 'Cancelled' ? 'tw-bg-red-100 tw-text-red-800' : 
                                    'tw-bg-yellow-100 tw-text-yellow-800') }}">
                                {{ $item->status }}
                            </span>
                        </div>
                    
                    <div class="tw-mt-2 tw-space-y-1">
                        @if($item->type === 'appointment')
                            <p class="tw-text-sm tw-text-gray-600">
                                <i class="far fa-clock tw-mr-2"></i>
                                {{ \Carbon\Carbon::parse($item->date)->format('M d, Y') }} at 
                                {{ \Carbon\Carbon::parse($item->time)->format('h:i A') }}
                            </p>
                        @else
                            <p class="tw-text-sm tw-text-gray-600">
                                <i class="far fa-calendar-alt tw-mr-2"></i>
                                {{ \Carbon\Carbon::parse($item->start_date)->format('M d, Y') }} - 
                                {{ \Carbon\Carbon::parse($item->end_date)->format('M d, Y') }}
                            </p>
                        @endif
                        
                        @foreach($item->payments as $payment)
                            <p class="tw-text-sm tw-text-gray-600">
                                <i class="fas fa-money-bill-wave tw-mr-2"></i>
                                {{ ucfirst($payment['type']) }}: ₱{{ number_format($payment['amount'], 2) }}
                                <span class="tw-text-xs tw-text-gray-500">
                                    ({{ $payment['payment_method'] }} - {{ \Carbon\Carbon::parse($payment['timestamp'])->format('M d, Y h:i A') }})
                                </span>
                            </p>
                        @endforeach
                    </div>
                </div>

                <!-- Right: Actions -->
                <div class="tw-flex tw-gap-2">
                <button onclick="viewDetails({{ $item->id }}, '{{ $item->type }}')" 
                        class="tw-text-[#24CFF4] tw-text-sm hover:tw-underline">
                    View Details
                </button>
                </div>
            </div>
        </div>
        @empty
        <div class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-bg-white tw-rounded-2xl tw-p-8 tw-shadow-sm" id="emptyState">
            <i class="fas fa-history tw-text-5xl tw-text-gray-300 tw-mb-4"></i>
            <p class="tw-text-gray-500 tw-mb-4">No history available</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination Controls -->
    @if(count($history) > 0)
    <div class="tw-mt-6 tw-flex tw-justify-center tw-items-center tw-gap-2" id="paginationControls">
        <button id="prevPage" class="tw-px-4 tw-py-2 tw-rounded-xl tw-bg-white tw-text-gray-700 tw-border tw-border-gray-200 hover:tw-bg-gray-50 tw-transition-all disabled:tw-opacity-50 disabled:tw-cursor-not-allowed">
            <i class="fas fa-chevron-left tw-mr-2"></i>Previous
        </button>
        <div id="pageNumbers" class="tw-flex tw-gap-2"></div>
        <button id="nextPage" class="tw-px-4 tw-py-2 tw-rounded-xl tw-bg-white tw-text-gray-700 tw-border tw-border-gray-200 hover:tw-bg-gray-50 tw-transition-all disabled:tw-opacity-50 disabled:tw-cursor-not-allowed">
            Next<i class="fas fa-chevron-right tw-ml-2"></i>
        </button>
    </div>
    <div class="tw-mt-2 tw-text-center tw-text-sm tw-text-gray-500" id="paginationInfo"></div>
    @endif
</div>

<script>
    let currentPage = 1;
    const itemsPerPage = 10;
    let filteredItems = [];
    let allItems = [];

    function jumpToDate(date) {
        const [year, month] = date.split('-');
        const monthYear = new Date(year, month - 1).toLocaleString('default', { month: 'long', year: 'numeric' });
        
        const monthHeaders = document.querySelectorAll('.tw-text-lg.tw-font-semibold.tw-text-gray-700');
        for (const header of monthHeaders) {
            if (header.textContent === monthYear) {
                header.scrollIntoView({ behavior: 'smooth', block: 'start' });
                break;
            }
        }
    }

    function initializeHistoryPage() {
        const searchHistory = document.getElementById('searchHistory');
        const typeFilters = document.querySelectorAll('.type-filter');
        const historyItems = document.querySelectorAll('.history-item');
        
        // Initialize all items array
        allItems = Array.from(historyItems);
        filteredItems = [...allItems];
        
        // Initialize pagination
        updatePagination();

        if (searchHistory) {
            searchHistory.addEventListener('input', filterHistory);
        }

        typeFilters.forEach(button => {
            button.addEventListener('click', () => {
                typeFilters.forEach(btn => {
                    btn.classList.remove('active');
                    btn.classList.remove('tw-bg-[#24CFF4]');
                    btn.classList.remove('tw-text-white');
                    btn.classList.add('tw-text-gray-500');
                    btn.classList.add('hover:tw-bg-gray-100');
                });
                button.classList.add('active');
                button.classList.add('tw-bg-[#24CFF4]');
                button.classList.add('tw-text-white');
                button.classList.remove('tw-text-gray-500');
                button.classList.remove('hover:tw-bg-gray-100');
                currentPage = 1; // Reset to first page when filtering
                filterHistory();
            });
        });

        // Pagination event listeners
        const prevBtn = document.getElementById('prevPage');
        const nextBtn = document.getElementById('nextPage');
        
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updatePagination();
                    scrollToTop();
                }
            });
        }
        
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
                if (currentPage < totalPages) {
                    currentPage++;
                    updatePagination();
                    scrollToTop();
                }
            });
        }

        function scrollToTop() {
            const timeline = document.getElementById('historyTimeline');
            if (timeline) {
                timeline.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }

        function filterHistory() {
            const searchTerm = searchHistory ? searchHistory.value.toLowerCase() : '';
            const activeType = document.querySelector('.type-filter.active')?.dataset.type || 'all';

            // Filter items based on search and type
            filteredItems = allItems.filter(item => {
                const serviceName = item.querySelector('h3')?.textContent.toLowerCase() || '';
                const petName = item.querySelector('p:first-of-type')?.textContent.toLowerCase() || '';
                const type = item.dataset.type;
                const status = item.dataset.status;
                
                const matchesSearch = serviceName.includes(searchTerm) || petName.includes(searchTerm);
                let matchesType = activeType === 'all' || type === activeType;
                
                // Handle status filters (Completed, Cancelled)
                if (activeType === 'Completed' || activeType === 'Cancelled') {
                    matchesType = status === activeType;
                }
                
                return matchesSearch && matchesType;
            });

            currentPage = 1; // Reset to first page
            updatePagination();
        }

        function updatePagination() {
            const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
            const startIndex = (currentPage - 1) * itemsPerPage;
            const endIndex = startIndex + itemsPerPage;

            // Hide all items and month headers first
            allItems.forEach(item => item.style.display = 'none');
            document.querySelectorAll('.month-header').forEach(header => header.style.display = 'none');
            
            // Show empty state if no filtered items
            const emptyState = document.getElementById('emptyState');
            const paginationControls = document.getElementById('paginationControls');
            const paginationInfo = document.getElementById('paginationInfo');
            
            if (filteredItems.length === 0) {
                if (emptyState) emptyState.style.display = 'flex';
                if (paginationControls) paginationControls.style.display = 'none';
                if (paginationInfo) paginationInfo.style.display = 'none';
                return;
            } else {
                if (emptyState) emptyState.style.display = 'none';
                if (paginationControls) paginationControls.style.display = 'flex';
                if (paginationInfo) paginationInfo.style.display = 'block';
            }

            // Show only filtered items for current page
            const pageItems = filteredItems.slice(startIndex, endIndex);
            pageItems.forEach(item => {
                item.style.display = 'block';
            });

            // Show month headers ONLY when there are visible items for that month
            document.querySelectorAll('.month-header').forEach(header => {
                const headerMonth = header.dataset.month;
                if (!headerMonth) {
                    return;
                }

                const hasVisibleItem = Array.from(document.querySelectorAll(`.history-item[data-month="${headerMonth}"]`))
                    .some(item => item.style.display !== 'none');

                if (hasVisibleItem) {
                    header.style.display = 'flex';
                } else {
                    header.style.display = 'none';
                }
            });

            // Update pagination buttons
            const prevBtn = document.getElementById('prevPage');
            const nextBtn = document.getElementById('nextPage');
            
            if (prevBtn) {
                prevBtn.disabled = currentPage === 1;
            }
            if (nextBtn) {
                nextBtn.disabled = currentPage === totalPages;
            }

            // Update page numbers
            updatePageNumbers(totalPages);
            
            // Update pagination info
            if (paginationInfo) {
                const showing = Math.min(endIndex, filteredItems.length);
                paginationInfo.textContent = `Showing ${startIndex + 1}-${showing} of ${filteredItems.length} items`;
            }
        }

        function updatePageNumbers(totalPages) {
            const pageNumbersContainer = document.getElementById('pageNumbers');
            if (!pageNumbersContainer) return;
            
            pageNumbersContainer.innerHTML = '';
            
            // Show max 5 page numbers
            let startPage = Math.max(1, currentPage - 2);
            let endPage = Math.min(totalPages, startPage + 4);
            
            // Adjust if we're near the end
            if (endPage - startPage < 4) {
                startPage = Math.max(1, endPage - 4);
            }
            
            // Add first page and ellipsis if needed
            if (startPage > 1) {
                addPageButton(1, pageNumbersContainer);
                if (startPage > 2) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'tw-px-2 tw-py-2 tw-text-gray-500';
                    ellipsis.textContent = '...';
                    pageNumbersContainer.appendChild(ellipsis);
                }
            }
            
            // Add page numbers
            for (let i = startPage; i <= endPage; i++) {
                addPageButton(i, pageNumbersContainer);
            }
            
            // Add ellipsis and last page if needed
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsis = document.createElement('span');
                    ellipsis.className = 'tw-px-2 tw-py-2 tw-text-gray-500';
                    ellipsis.textContent = '...';
                    pageNumbersContainer.appendChild(ellipsis);
                }
                addPageButton(totalPages, pageNumbersContainer);
            }
        }

        function addPageButton(pageNum, container) {
            const button = document.createElement('button');
            button.textContent = pageNum;
            button.className = `tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all ${
                pageNum === currentPage 
                    ? 'tw-bg-[#24CFF4] tw-text-white' 
                    : 'tw-bg-white tw-text-gray-700 tw-border tw-border-gray-200 hover:tw-bg-gray-50'
            }`;
            button.addEventListener('click', () => {
                currentPage = pageNum;
                updatePagination();
                scrollToTop();
            });
            container.appendChild(button);
        }
    }

    window.viewDetails = function(id, type) {
        console.log('Viewing details for:', id, 'Type:', type);
        
        // Determine which modal to open based on the type
        if (type === 'appointment') {
            // Check if the appointment modal function exists
            if (typeof window.openAppointmentModal === 'function') {
                window.openAppointmentModal(id);
            } else {
                console.error('openAppointmentModal function not found');
                Swal.fire({
                    title: 'Error',
                    text: 'Could not load appointment details',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
            }
        } else if (type === 'boarding') {
            // Check if the boarding modal function exists
            if (typeof window.openViewBoardingModal === 'function') {
                window.openViewBoardingModal(id);
            } else {
                console.error('openViewBoardingModal function not found');
                Swal.fire({
                    title: 'Error',
                    text: 'Could not load boarding details',
                    icon: 'error',
                    confirmButtonColor: '#24CFF4'
                });
            }
        }
    }

// Initialize on direct page load
document.addEventListener('DOMContentLoaded', initializeHistoryPage);

// Initialize when content is dynamically loaded
document.addEventListener('contentChanged', initializeHistoryPage);

// Add this to your main layout file to trigger contentChanged event
window.addEventListener('popstate', function() {
    document.dispatchEvent(new Event('contentChanged'));
});

// If you're using any click handlers for navigation, add this after loading new content
// document.dispatchEvent(new Event('contentChanged'));
</script>

@include('modals.user.edit-appointment')
@include('modals.user.add-appointment')
@include('modals.user.edit-boarding')
@include('modals.user.add-boarding')
@include('modals.user.add-pet')
@include('modals.user.payment-modal')
@include('modals.user.view-boarding')
@include('modals.user.view-appointment')

@endsection