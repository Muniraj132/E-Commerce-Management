<x-app-layout>
    <div class="row mt-3">
        <!-- User Card -->
        <!-- User Count Card -->
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-users fa-3x"></i>
                        </div>
                        <div class="text-right">
                            <h5 class="card-title">Users</h5>
                            <p class="card-text">Total Users:</p>
                            <strong>{{ $userCount ?? '' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-chart-bar fa-3x"></i>
                        </div>
                        <div class="text-right">
                            <h5 class="card-title">Categories</h5>
                            <p class="card-text">Total Categories:</p>
                            <strong>{{ $categoryCount ?? '' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Card -->
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-shopping-cart fa-3x"></i>
                        </div>
                        <div class="text-right">
                            <h5 class="card-title">Products</h5>
                            <p class="card-text">Total Products:</p>
                            <strong>{{ $productCount ?? '' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Card (Replace with your data) -->
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-chart-bar fa-3x"></i>
                        </div>
                        <div class="text-right">
                            <h5 class="card-title">Orders</h5>
                            <p class="card-text">Total Orders:</p>
                            <strong>{{ $OrderCount ?? '' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
