(() => {
	async function getPatientNumber(category = 'personal') {
		try {
			const res = await fetch('/api/patients.php?getNewNumber&category=' + category);
			const data = await res.json();
			if (data.ok) {
				return data.data['card-number'];
			}
		} catch (err) {
			console.error(err);
		}
	}
	window.addEventListener('load', () => {
		try {
			document.querySelector('#generateNumber').addEventListener('click', async function () {
				const category = document.querySelector('#category').value;
				const number = await getPatientNumber(category);
				document.querySelector('#card-number').value = number;
			});
		} catch (e) {}
	});

	window.addEventListener('load', () => {
		function format(d) {
			return `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px">
				<tr>
					<td>Full name:</td>
					<td>${d.name}</td>
				</tr>
				<tr>
					<td>Date of Birth:</td>
					<td>${d.birthDate}</td>
				</tr>
				<tr>
					<td>E-mail:</td>
					<td>${d.email}</td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td>${d.phone}</td>
				</tr>
				<tr>
					<td>Gender:</td>
					<td>${d.gender}</td>
				</tr>
				<tr>
					<td><a href="/patient.php?patient=${d['card-no']}">View</a></td>
				</tr>
			</table>`;
		}
		const table = $('#data-table').DataTable({
			ajax: {
				url: '/api/patients.php',
				dataSrc: '',
			},
			columns: [
				{
					className: 'details-control',
					orderable: false,
					data: null,
					defaultContent: '',
				},
				{ data: 'card-no' },
				{ data: 'name' },
				{ data: 'category' },
			],
			order: [[1, 'asc']],
			language: {
				search: 'Type to search: ',
			},
		});

		$('#data-table tbody').on('click', 'td.details-control', function () {
			const tr = $(this).closest('tr');
			const row = table.row(tr);

			if (row.child.isShown()) {
				row.child.hide();
				tr.removeClass('shown');
			} else {
				row.child(format(row.data())).show();
				tr.addClass('shown');
			}
		});
	});
})();
