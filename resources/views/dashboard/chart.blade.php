<div class="row">
	<div class="col-xl-6 col-xxl-7">
		<div class="card flex-fill w-100">
			<div class="card-header">
				<div class="card-actions float-end">
					<a href="#" class="me-1">
						<i class="align-middle" data-feather="refresh-cw"></i>
					</a>
					<div class="d-inline-block dropdown show">
						<a href="#" data-bs-toggle="dropdown" data-bs-display="static">
							<i class="align-middle" data-feather="more-vertical"></i>
						</a>

						<div class="dropdown-menu dropdown-menu-end">
							<a class="dropdown-item" asp-action="Index" asp-route-Year="">2023</a>
							<a class="dropdown-item" asp-action="Index" asp-route-Year="">2022</a>
						</div>
					</div>
				</div>
				<h5 class="card-title mb-0">Failur Monitoring</h5>
			</div>
			<div class="card-body py-3">
				<div class="chart chart-sm">
					<canvas id="chartjs-dashboard-bar-alt"></canvas>
				</div>
			</div>
		</div>
	</div>


	<div class="col-xl-6 col-xxl-5 d-flex">
		<div class="w-100">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Main Dealer</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-primary-dark">
											<i class="align-middle" data-feather="home"></i>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-2 mb-4">
								13
							</h1>
							<div class="mb-0">
								<span class="text-primary"> <i class="mdi mdi-arrow-bottom-right"></i>
									{{-- @String.Format("{0:n0}", Model.Dashboard.Sum(m => m.IncomingQuantity)) items --}}
								</span>
							</div>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Feature</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-primary-dark">
											<i class="align-middle" data-feather="package"></i>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-2 mb-4">
								153
							</h1>
							<div class="mb-0">
								<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 
									Apps
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-6">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">API</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-primary-dark">
											<i class="align-middle" data-feather="droplet"></i>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-2 mb-4">
								518
							</h1>
						</div>
					</div>
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col mt-0">
									<h5 class="card-title">Failur</h5>
								</div>

								<div class="col-auto">
									<div class="avatar">
										<div class="avatar-title rounded-circle bg-danger-dark">
											<i class="align-middle" data-feather="x-circle"></i>
										</div>
									</div>
								</div>
							</div>
							<h1 class="display-5 mt-2 mb-4">
                                0
                            </h1>
							<div class="mb-0">
								<span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 
									in 2023
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>