$(() => {
	const table = new Table($('table.data-table')[0]);
	table.loadData({
		url: '/api/staff.php',
		failureCallback: (err) => {
			console.error(err);
		},
		paginate: true,
		successCallback: (data) => {
			let text = '';
			data.forEach((row) => {
				let tr = `<tr>
					<td class="show-more"></td>
					<td>${row.name}</td>
					<td>${row.office ? row.office.toUpperCase() : row.office}</td>
				</tr>
				<tr class="extra-info">
					<td>
						<p><b>Title:</b> ${row.title.capitalize()}</p>
						<p><b>Name:</b> ${row.name}</p>
						<p><b>Department:</b> ${row.office ? row.office.toUpperCase() : row.office}</p>
						<p><b>Phone:</b> ${row.phone}</p>
						<p><b>E-mail:</b> ${row.email}</p>
						<p><b>Facebook:</b> ${row.facebook}</p>
						<p><b>Twitter:</b> ${row.twitter}</p>
						<p><b>LinkedIn:</b> ${row.linkedin}</p>
					</td>
				</tr>`;

				text += tr;
			});
			return text;
		},
	});
});
