$(() => {
	window.addEventListener('load', () => {
		function format(d) {
			return `<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">
				<tr>
					<td>Full name:</td>
					<td>${d.name}</td>
				</tr>
				<tr>
					<td>E-mail</td>
					<td>${d.email}</td>
				</tr>
				<tr>
					<td>Phone Number:</td>
					<td>${d.phone}</td>
				</tr>
				<tr>
					<td>Office:</td>
					<td>${d.office}</td>
				</tr>
				<tr>
					<td><a href="/staff.php?staff=${d.id}">View</a></td>
				</tr>
			</table>`;
		}
		const table = $('.data-table').DataTable({
			ajax: {
				url: '/api/staff.php',
				dataSrc: '',
			},
			columns: [
				{
					className: 'details-control',
					orderable: false,
					data: null,
					defaultContent: '',
				},
				{ data: 'name' },
				{ data: 'office' },
			],
			language: {
				search: 'Type to search: ',
			},
			lengthChange: false,
		});

		$('.data-table tbody').on('click', 'td.details-control', function () {
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
});
