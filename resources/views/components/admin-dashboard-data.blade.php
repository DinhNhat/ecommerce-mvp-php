<div class="row g-4">
    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card" style="height: 170px;">
            <div class="card-body">
              <h5 class="card-title">Sales</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{ $numberofSales }}</h6>
              <p class="card-text mt-4">{{ $amount }}</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card" style="height: 170px;">
            <div class="card-body">
              <h5 class="card-title">Customer</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{ $avarageValuePerUser }} Avarage Value</h6>
              <p class="card-text mt-4">{{ $numberOfUsers }}</p>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card" style="height: 170px;">
            <div class="card-body">
              <h5 class="card-title">Active Products</h5>
              <h6 class="card-subtitle mb-2 text-muted">{{ $inactiveProducts }} Inactive</h6>
              <p class="card-text mt-4">{{ $activeProducts }}</p>
            </div>
        </div>
    </div>
</div>