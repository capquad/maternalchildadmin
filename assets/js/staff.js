import Table from './DataTable.js';
$(() => {
	const table = new Table($('table.data-table')[0]);
	table.loadData({
		url: 'http://localhost:8000/api/staff.php',
		failureCallback: (err) => {
			console.error(err);
		},
		successCallback: (data) => {
			let text = '';
			data.forEach((row) => {
				let tr = `<tr>
					<td class="show-more"></td>
					<td>${row.name}</td>
					<td>${row.office.toUpperCase()}</td>
				</tr>
				<tr class="extra-info">
					<td>
						<p><b>Name:</b> ${row.name}</p>
						<p><b>Department:</b> ${row.office.toUpperCase()}</p>
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
