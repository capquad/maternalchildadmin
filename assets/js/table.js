$(() => {
	const table = new Table($('table.data-table')[0]);
	table.attachSearchBar();
	table.loadData({
		url: '/api/patients.php',
		data: { 'card-no': 'ID', name: 'Name', category: 'Category' },
		paginate: true,
		successCallback: function (d) {
			// console.log(d);
			let text = '';
			d.forEach((row) => {
				let tr = `
        <tr>
          <td class="show-more"></td>
          <td>${row['card-no']}</td>
          <td>${row.name}</td>
          <td>${row.category.capitalize()}</td>
        </tr>
        <tr class='extra-info'>
          <td>
            <p><b>Name:</b> ${row.name}</p>
						<p><b>E-mail:</b> ${row.email}</p>
						<p><b>Phone Number:</b> ${row.phone}</p>
						<p><b>Date of Birth:</b> ${row.birthDate}</p>
						<p><b>Gender:</b> ${row.gender.capitalize()}</p>
						<p>
						<a href="/patient.php?patient=${row['card-no']}" class="btn btn-dark">View</a>
						</p>
          </td>
        </tr>
        `;
				text += tr;
			});
			return text;
		},
		failureCallback: (err) => {
			console.error(err);
		},
	});
});
