<div id="main">
	<div class="container py-4">
		<h1><?= $staff['name'] ?></h1>
	</div>

	<div class="container">
		<form action="/api/staff.php?endpoint=update" class="async-form" id="staffForm" data-redirect="/staff.php?staff=<?= $staffId ?>">
			<div class="form-group">
				<label for="f-title">Title</label>
				<div class="row">
					<input type="hidden" id="title" name="title" value="<?= $staff['title'] ?>">
					<div class="col-10">
						<select id="f-title" class="form-control false-9" required="required" disabled="disabled" data-origin='#title'>
							<option value="mr" <?= $staff['title'] === 'mr' ? "selected='selected'" : '' ?>>Mr.</option>
							<option value="mrs" <?= $staff['title'] === 'mrs' ? "selected='selected'" : '' ?>>Mrs.</option>
							<option value="engr" <?= $staff['title'] === 'engr' ? "selected='selected'" : '' ?>>Engr.</option>
							<option value="dr" <?= $staff['title'] === 'dr' ? "selected='selected'" : '' ?>>Dr.</option>
						</select>
					</div>
					<div class="col-2">
						<button type="button" data-target="#f-title" data-property="disabled" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row align-items-center align-content-center">
					<label for="firstname">Firstname</label>
					<div class="col-10">
						<input type="text" name="firstname" id="firstname" class="form-control" required readonly value="<?= $staff['firstname'] ?>">
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger my-0" data-property='readonly' data-target='#firstname'>Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<div class="row">
					<label for="lastname">Lastname</label>
					<div class="col-10">
						<input type="text" name="lastname" id="lastname" required="required" readonly="readonly" class="form-control" value="<?= $staff['lastname'] ?>">
					</div>
					<div class="col-2">
						<button type="button" data-property="readonly" data-target="#lastname" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="middlename">Middlename</label>
				<div class="row">
					<div class="col-10">
						<input type="text" name="middlename" id="middlename" readonly="readonly" class="form-control" value="<?= $staff['middlename'] ?>">
					</div>
					<div class="col-2">
						<button type="button" data-target="#middlename" data-property="readonly" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="f-gender">Gender</label>
				<div class="row">
					<input type="hidden" id="gender" name="gender" value="<?= $staff['gender'] ?>">
					<div class="col-10">
						<select id="f-gender" class="form-control" required="required" disabled="disabled">
							<option value="male" <?= $staff['gender'] === 'male' ? "selected='selected'" : '' ?>>Male</option>
							<option value="female" <?= $staff['gender'] === 'female' ? "selected='selected'" : '' ?>>Female</option>
						</select>
					</div>
					<div class="col-2">
						<button type="button" data-target="#f-gender" data-property="disabled" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="phone">Phone Number</label>
				<div class="row">
					<div class="col-10">
						<input type="text" name="phone" id="phone" required="required" readonly="readonly" class="form-control" value="<?= $staff['phone'] ?>">
					</div>
					<div class="col-2">
						<button type="button" data-target="#phone" data-property="readonly" class="btn btn-danger my-0">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label for="email">E-mail Address</label>
				<div class="row">
					<div class="col-10">
						<input type="email" name="email" id="email" class="form-control" required="required" readonly="readonly" value="<?= $staff['email'] ?>">
					</div>
					<div class="col-2"><button type="button" class="btn btn-danger my-0" data-property="readonly" data-target="#email">Edit</button></div>
				</div>
			</div>
			<div class="form-group">
				<label for="birthdate">Date of Birth</label>
				<div class="row">
					<div class="col-10">
						<input type="date" name="birthdate" id="birthdate" required="required" readonly="readonly" class="form-control" value="<?= $staff['birthDate'] ?>">
					</div>
					<div class="col-2"><button class="btn btn-danger my-0" type="button" data-property="readonly" data-target="#birthdate">Edit</button></div>
				</div>
			</div>
			<div class="form-group">
				<label for="f-department">Department</label>
				<div class="row">
					<input type="hidden" id="department" name="office" value="<?= $staff['office'] ? $staff['office'] : 'ict' ?>">
					<div class="col-10">
						<select name="f-department" id="f-department" class="form-control" data-origin="#department" disabled>
							<option value="ict" <?= $staff['office'] === 'ict' ? "selected='selected'" : '' ?> selected>ICT</option>
							<option value="records" <?= $staff['office'] === 'records' ? "selected='selected'" : '' ?>>Records</option>
							<option value="pharm" <?= $staff['office'] === 'pharm' ? "selected='selected'" : '' ?>>Pharmacy</option>
							<option value="facility" <?= $staff['office'] === 'facility' ? "selected='selected'" : '' ?>>Facility</option>
						</select>
					</div>
					<div class="col-2">
						<button type="button" class="btn btn-danger my-0" data-property="disabled" data-target="#f-department">Edit</button>
					</div>
				</div>
			</div>
			<div class="form-group">
				<input type="hidden" name="staff" value="<?= $staff['id'] ?>" />
				<input type="submit" class="btn btn-primary" value="Submit" name="updatePatient" />
			</div>
		</form>
	</div>
</div>