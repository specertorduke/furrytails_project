@extends('admin.adminLayout')

@section('title', 'Payments Management')

@section('content')
<div class="tw-p-6 tw-min-h-screen tw-bg-gray-900">
    <!-- Header Section -->
    <div class="tw-flex tw-flex-col md:tw-flex-row tw-justify-between tw-items-start md:tw-items-center tw-mb-6">
        <div>
            <p class="tw-text-sm tw-text-gray-400">Administration / Payments</p>
            <h1 class="tw-text-2xl tw-font-bold tw-text-white">Payments Management</h1>
        </div>
        <div class="tw-mt-4 md:tw-mt-0">
            <button type="button" id="addPaymentBtn" class="tw-bg-green-600 tw-text-white tw-px-4 tw-py-2 tw-rounded-xl tw-transition-all tw-duration-300 hover:tw-shadow-lg hover:tw-opacity-90 tw-font-semibold active:tw-bg-green-700">
                <i class="fas fa-plus-circle tw-mr-2"></i> Record Payment
            </button>
        </div>
    </div>

    <!-- Payment Stats Cards -->
    <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-6 tw-mb-6">
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-green-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Payments</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $totalPayments ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-money-bill-wave tw-text-green-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-blue-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Completed</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $completedPayments ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-check-circle tw-text-blue-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-yellow-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Pending</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">{{ $pendingPayments ?? 0 }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-clock tw-text-yellow-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
        <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-border-l-4 tw-border-red-500 tw-transition-all tw-duration-300 hover:tw-shadow-md">
            <div class="tw-flex tw-justify-between tw-items-center">
                <div>
                    <p class="tw-text-gray-400 tw-text-sm">Total Revenue</p>
                    <h3 class="tw-text-2xl tw-font-bold tw-text-white">₱{{ number_format($totalRevenue ?? 0, 2) }}</h3>
                </div>
                <div class="tw-bg-gray-700 tw-p-3 tw-rounded-full">
                    <i class="fas fa-file-invoice-dollar tw-text-red-500 tw-text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Controls -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-overflow-x-auto tw-shadow-sm tw-p-4 tw-mb-6">
        <div class="tw-grid tw-grid-cols-1 md:tw-grid-cols-4 tw-gap-4">
            <div class="">
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Status</label>
                <select id="status-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <option value="">All Statuses</option>
                    <option value="Pending">Pending</option>
                    <option value="Completed">Completed</option>
                    <option value="Failed">Failed</option>
                    <option value="Refunded">Refunded</option>
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Payment Method</label>
                <select id="payment-method-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <option value="">All Methods</option>
                    <option value="Cash">Cash</option>
                    <option value="Credit Card">Credit Card</option>
                    <option value="Debit Card">Debit Card</option>
                    <option value="PayPal">PayPal</option>
                    <option value="GCash">GCash</option>
                    <option value="Bank Transfer">Bank Transfer</option>
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Service Type</label>
                <select id="service-type-filter" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <option value="">All Services</option>
                    <option value="App\Models\Appointment">Appointment</option>
                    <option value="App\Models\Boarding">Boarding</option>
                </select>
            </div>
            <div>
                <label class="tw-block tw-text-sm tw-font-medium tw-text-gray-300 tw-mb-1">Date Range</label>
                <div class="tw-flex tw-gap-2">
                    <input type="date" id="date-from" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                    <input type="date" id="date-to" class="tw-w-full tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2">
                </div>
            </div>
        </div>
    </div>

    <!-- Payments Table -->
    <div class="tw-bg-gray-800 tw-rounded-xl tw-shadow-sm tw-p-6 tw-overflow-x-auto">
        <div>
            <table id="paymentsTable" class="tw-min-w-full tw-divide-y tw-divide-gray-700">
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Create a namespace for our payments page functionality
    window.PaymentsPage = window.PaymentsPage || {
        paymentsTable: null,

        // CRUD Functions
        viewPayment: function(id) {
            console.log('View payment', id);
            // Implement view functionality
        },

        editPayment: function(id) {
            console.log('Edit payment', id);
            // Implement edit functionality
        },

        markAsRefunded: function(id) {
            Swal.fire({
                title: 'Mark as refunded?',
                text: "This will update the payment status.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, mark as refunded!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make AJAX call to update status
                    fetch(`/admin/payments/${id}/refund`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success) {
                            this.paymentsTable.ajax.reload();
                            Swal.fire('Updated!', 'Payment has been marked as refunded.', 'success');
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to update payment.', 'error');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'An error occurred while updating the payment.', 'error');
                    });
                }
            });
        },

        initializeTables: function() {
            console.log('Initializing payments table...');
            
            // Destroy existing table first
            this.destroyTables();
            $('#paymentsTable').empty();

            // Setup table structure with headers
            $('#paymentsTable').html(`
                <thead class="tw-bg-gray-700">
                    <tr>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">ID</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Date</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Client</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Service</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Amount</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Method</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Reference</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Status</th>
                        <th class="tw-px-4 tw-py-3 tw-text-left tw-text-xs tw-font-medium tw-text-gray-300 tw-uppercase tw-tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            `);
            
            // Initialize payments table
            this.paymentsTable = $('#paymentsTable').DataTable({
                serverSide: false,
                ajax: {
                    url: '{{ route("admin.payments.data") }}',
                    type: 'GET',
                    dataSrc: function(json) {
                        // Check if there's an error
                        if (json.error) {
                            console.error('Server returned error:', json.error);
                            return [];
                        }
                        return json.data || [];
                    },
                    error: function(xhr, error, thrown) {
                        console.error('Payments Ajax error:', xhr);
                        console.error('Status text:', xhr.statusText);
                        console.error('Response text:', xhr.responseText);
                    }
                },
                columns: [
                    { data: 'paymentID', width: '5%' },
                    { 
                        data: 'created_at',
                        width: '10%',
                        render: function(data) {
                            return moment(data).format('MMM DD, YYYY h:mm A');
                        }
                    },
                    { 
                        data: null,
                        width: '15%',
                        render: function(data) {
                            try {
                                const firstName = data.user?.firstName || 'Unknown';
                                const lastName = data.user?.lastName || 'User';
                                
                                return `
                                    <div class="tw-flex tw-items-center">
                                        <div class="tw-h-8 tw-w-8 tw-rounded-full tw-bg-gray-700 tw-flex tw-justify-center tw-items-center">
                                            <i class="fas fa-user tw-text-gray-400"></i>
                                        </div>
                                        <div class="tw-ml-3">
                                            <div class="tw-text-sm tw-font-medium tw-text-gray-200">${firstName} ${lastName}</div>
                                        </div>
                                    </div>
                                `;
                            } catch(e) {
                                console.error('Error rendering user data:', e);
                                return '<div class="tw-text-red-400">Error</div>';
                            }
                        }
                    },
                    { 
                        data: 'payable_type',
                        width: '15%',
                        render: function(data, type, row) {
                            // Extract the model name from namespace
                            const modelName = data.split('\\').pop();
                            
                            // Format service type with appropriate icon
                            let icon, serviceName;
                            if (modelName === 'Appointment') {
                                icon = '<i class="fas fa-calendar-check tw-text-[#FF9666] tw-mr-2"></i>';
                                serviceName = row.service_info?.name || 'Appointment';
                            } else if (modelName === 'Boarding') {
                                icon = '<i class="fas fa-home tw-text-[#24CFF4] tw-mr-2"></i>';
                                serviceName = 'Boarding';
                            } else {
                                icon = '<i class="fas fa-question-circle tw-text-gray-400 tw-mr-2"></i>';
                                serviceName = modelName || 'Unknown';
                            }
                            
                            return `<div class="tw-flex tw-items-center">${icon} ${serviceName}</div>`;
                        }
                    },
                    { 
                        data: 'amount',
                        width: '10%',
                        render: function(data) {
                            return '₱' + parseFloat(data).toFixed(2);
                        }
                    },
                    { 
                        data: 'payment_method',
                        width: '10%',
                        render: function(data) {
                            let icon = 'fa-money-bill-wave';
                            
                            if (data === 'Credit Card' || data === 'Debit Card') {
                                icon = 'fa-credit-card';
                            } else if (data === 'PayPal') {
                                icon = 'fa-paypal';
                            } else if (data === 'GCash') {
                                icon = 'fa-mobile-alt';
                            } else if (data === 'Bank Transfer') {
                                icon = 'fa-university';
                            }
                            
                            return `<div class="tw-flex tw-items-center"><i class="fas ${icon} tw-mr-2 tw-text-gray-400"></i> ${data}</div>`;
                        }
                    },
                    { 
                        data: 'reference_number',
                        width: '10%',
                        render: function(data) {
                            return data || '<span class="tw-text-gray-500">N/A</span>';
                        }
                    },
                    { 
                        data: 'status',
                        width: '10%',
                        render: function(data) {
                            let badgeClass;
                            let iconClass;
                            
                            switch(data) {
                                case 'Completed':
                                    badgeClass = 'tw-bg-green-900 tw-text-green-300';
                                    iconClass = 'tw-text-green-300 fa-check-circle';
                                    break;
                                case 'Pending':
                                    badgeClass = 'tw-bg-yellow-900 tw-text-yellow-300';
                                    iconClass = 'tw-text-yellow-300 fa-clock';
                                    break;
                                case 'Failed':
                                    badgeClass = 'tw-bg-red-900 tw-text-red-300';
                                    iconClass = 'tw-text-red-300 fa-times-circle';
                                    break;
                                case 'Refunded':
                                    badgeClass = 'tw-bg-purple-900 tw-text-purple-300';
                                    iconClass = 'tw-text-purple-300 fa-undo';
                                    break;
                                default:
                                    badgeClass = 'tw-bg-gray-900 tw-text-gray-300';
                                    iconClass = 'tw-text-gray-300 fa-question-circle';
                            }
                            
                            return `<span class="tw-px-2 tw-py-1 tw-rounded-full tw-text-xs ${badgeClass}">
                                <i class="fas ${iconClass} tw-mr-1"></i> ${data}
                            </span>`;
                        }
                    },
                    {
                        data: null,
                        width: '15%',
                        render: function(data) {
                            const refundBtn = data.status === 'Completed' ? 
                                `<button onclick="PaymentsPage.markAsRefunded(${data.paymentID})" class="tw-text-purple-500 hover:tw-text-purple-300">
                                    <i class="fas fa-undo"></i>
                                </button>` : '';
                                
                            return `
                                <div class="tw-flex tw-space-x-3 tw-justify-center">
                                    <button onclick="PaymentsPage.viewPayment(${data.paymentID})" class="tw-text-[#24CFF4] hover:tw-text-blue-300">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button onclick="PaymentsPage.editPayment(${data.paymentID})" class="tw-text-yellow-500 hover:tw-text-yellow-300">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    ${refundBtn}
                                </div>
                            `;
                        },
                        orderable: false
                    }
                ],
                autoWidth: false,
                scrollX: false,
                dom: 'Blfrtip',
                lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
                buttons: [
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print tw-mr-2"></i> Print',
                        className: 'tw-text-white tw-bg-gray-700 tw-border-gray-600 tw-rounded-md tw-px-3 tw-py-2 tw-mr-2 hover:tw-bg-gray-600',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        },
                        title: 'Payments Report'
                    }
                ],
                language: {
                    lengthMenu: "_MENU_ per page",
                    search: "_INPUT_",
                    searchPlaceholder: "Search payments..."
                },
                order: [[1, 'desc']], // Order by date desc
                drawCallback: function() {
                    PaymentsPage.applyTableStyling();
                }
            });

            // Apply filters
            this.setupFilters();
        },

        setupFilters: function() {
            // Apply filters on change
            $('#status-filter, #payment-method-filter, #service-type-filter, #date-from, #date-to').on('change', () => {
                this.applyFilters();
            });
        },

        applyFilters: function() {
            const statusFilter = $('#status-filter').val();
            const methodFilter = $('#payment-method-filter').val();
            const serviceTypeFilter = $('#service-type-filter').val();
            const dateFrom = $('#date-from').val();
            const dateTo = $('#date-to').val();
            
            $.fn.dataTable.ext.search.push((settings, data, dataIndex) => {
                const rowData = this.paymentsTable.row(dataIndex).data();
                
                // Status filter
                if (statusFilter && rowData.status !== statusFilter) {
                    return false;
                }
                
                // Payment method filter
                if (methodFilter && rowData.payment_method !== methodFilter) {
                    return false;
                }
                
                // Service type filter (payable_type)
                if (serviceTypeFilter && rowData.payable_type !== serviceTypeFilter) {
                    return false;
                }
                
                // Date range filter
                if (dateFrom || dateTo) {
                    const createdAt = moment(rowData.created_at);
                    
                    if (dateFrom && createdAt.isBefore(moment(dateFrom))) {
                        return false;
                    }
                    
                    if (dateTo && createdAt.isAfter(moment(dateTo).endOf('day'))) {
                        return false;
                    }
                }
                
                return true;
            });
            
            this.paymentsTable.draw();
            
            // Clear the custom filter
            $.fn.dataTable.ext.search.pop();
        },

        destroyTables: function() {
            if ($.fn.DataTable.isDataTable('#paymentsTable')) {
                console.log('Destroying existing DataTable');
                $('#paymentsTable').DataTable().clear().destroy();
                // Empty the table to remove any headers/content
                $('#paymentsTable').empty();
            }
        },

        applyTableStyling: function() {
            // Style DataTable elements to match dark theme
            $('.dataTables_wrapper .dataTables_length select').addClass('tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg');
            $('.dataTables_wrapper .dataTables_filter input').addClass('tw-bg-gray-700 tw-text-white tw-border-gray-600 tw-rounded-lg tw-px-3 tw-py-2');
            $('.dataTables_wrapper .dataTables_info').addClass('tw-text-gray-400 tw-mt-3');
            $('.dataTables_wrapper .dataTables_paginate').addClass('tw-text-gray-400');
            $('.dataTables_wrapper .paginate_button').addClass('tw-text-gray-400 hover:tw-text-white');
            $('.dataTables_wrapper .paginate_button.current').addClass('tw-bg-gray-700 !tw-text-white !tw-border-gray-600 hover:!tw-bg-gray-600');
            $('.dataTables_wrapper .paginate_button:not(.current)').addClass('tw-bg-transparent !tw-border-gray-700');
        }
    };

    // Initialize tables when page loads directly
    $(document).ready(function() {
        console.log('Document ready, jQuery version:', $.fn.jquery);
        // Check if DataTable is available
        if (!$.fn.DataTable) {
            console.error('DataTables is not loaded!');
        } else {
            console.log('DataTables is loaded, version:', $.fn.DataTable.version);
            PaymentsPage.initializeTables();
        }
        
        $('#addPaymentBtn').click(function() {
            console.log('Add payment button clicked');
            // Implement add payment functionality
        });
    });

    // Handle dynamic content changes
    document.addEventListener('contentChanged', function() {
        console.log('Content changed event received');
        // Make sure jQuery and DataTables are available
        if (window.jQuery && $.fn.DataTable) {
            PaymentsPage.initializeTables();
        } else {
            console.error('jQuery or DataTables not available on content change');
        }
    });

    // Cleanup when content will change
    document.addEventListener('contentWillChange', function() {
        console.log('Content will change event received');
        if (window.jQuery && $.fn.DataTable) {
            PaymentsPage.destroyTables();
        }
    });
</script>
@endpush
@endsection