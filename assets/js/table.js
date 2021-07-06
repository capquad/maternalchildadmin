import Table from './DataTable.js';

$(() => {
	const table = new Table($('table.data-table')[0]);
	table.loadData({
		url: 'http://localhost:3000/patients',
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
          <td>${row.category}</td>
        </tr>
        <tr class='extra-info'>
          <td>
            <p>Name: Hello</p>
          
          </td>
        </tr>
        `;
				text += tr;
			});
			return text;
		},
	});
});
