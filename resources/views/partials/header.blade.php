	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid navigation" id="top">
			<div class="row">
				<div id="form" class="search-form col-xs-6 col-xs-offset-3">
					<form method="get" action="/search" class="navbar-form form-inline">
						<div class="form-group">

							<input type="hidden" name="features" id="features" class="filters">
							<div class="checkbox features-select hidden">
								<label>
									<input type="checkbox" class="filter-value" value="smoking"> Smoking Allowed
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="food"> Kitchen
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="pet_friendly"> Pets Allowed
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="bikes"> Bike Racks
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="live_music"> Live Music
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="reservations"> Reservations Needed
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="tvs"> TVs
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="18+"> 18+
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="kids"> Kids allowed
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="patio"> Outdoor Seating
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="pool"> Pool Tables
								</label>
								<label>
									<input type="checkbox" class="filter-value" value="darts"> Darts
								</label>
							</div>
							<input type="text" class="form-control" name="searchTerm" placeholder="Search">
							<button type="button" class="filter btn btn-default">Filter</button>
							<button type="submit" class="btn btn-default">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>