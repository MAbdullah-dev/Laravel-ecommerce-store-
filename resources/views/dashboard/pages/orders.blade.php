<x-dashboard_component>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Order Mangement System</h4>
                            <div class="container mt-5">
                                <table class="table" id="ordersTable">
                                    <thead>
                                        <tr>
                                            <th>Order ID</th>
                                            <th>User Name</th>
                                            <th>Grand Total</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard_component>
<script>
    $(document).ready(function() {
        $('#ordersTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('orders') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'user.name', name: 'user.name' },
                { data: 'grand_total', name: 'grand_total' },
                {
                data: 'status',
                name: 'status',
                render: function(data, type, row) {
                    var statusClass = '';
                    if (data === 'Pending') {
                        statusClass = 'bg-info';
                    } else if (data === 'Rejected') {
                        statusClass = 'bg-danger';
                    } else if (data === 'Approved') {
                        statusClass = 'bg-success';
                    }
                    return '<span class="' + statusClass + ' p-2 text-white">' + data + '</span>';
                }
            },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });

    });
    </script>
