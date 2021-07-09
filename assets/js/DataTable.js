class Table {
	#table;
	#elemCount;
	#loadedData;
	options = {
		paginate: true,
		pageCount: 10,
	};

	constructor(element, options = null) {
		this.#table = element;
	}

	/**
	 * Initialize table functions
	 * @param {*} options
	 */
	initTable(options = null) {
		// console.log(this.#loadedData);
		if (this.#loadedData) {
			this.fillLoadData();
		}

		this.#table.querySelectorAll('.extra-info').forEach((row) => {
			row.classList.add('hidden');
		});
		const cell = this.#table.querySelectorAll('.extra-info td');
		const tableLength = this.#table.querySelectorAll('thead th').length;
		cell.forEach((row) => {
			row.setAttribute('colspan', tableLength);
		});

		this.#table.querySelectorAll('td.show-more').forEach((cell) => {
			let button = document.createElement('button');
			button.innerHTML = `<i class='fa fa-plus'></i>`;
			button.addEventListener('click', () => {
				let element = cell.parentElement.nextElementSibling;
				if (element.classList.contains('hidden')) {
					if (button.innerHTML == `<i class="fa fa-plus"></i>`) {
						button.innerHTML = `<i class='fa fa-minus'></i>`;
					} else {
						button.innerHTML = `<i class='fa fa-plus'></i>`;
					}
					button.classList.toggle('active');
					element.classList.toggle('show');
				}
			});
			cell.appendChild(button);
		});

		if (options) {
			this.options = options;
		}

		const infoDiv = document.createElement('div');
		infoDiv.classList.add('table-info');
		infoDiv.innerHTML = 'Showing 0 - 10 of 15 items';
		this.#table.parentElement.append(infoDiv);
		this.infoDiv = infoDiv;

		if (this.options.paginate) {
			const div = document.createElement('div');
			div.classList.add('paginate');

			this.#table.parentElement.append(div);
			this.pagination = div;
		}
	}

	/**
	 * Attach a search bar to the table
	 */
	attachSearchBar() {
		const search = document.createElement('div');
		const input = document.createElement('input');

		search.classList.add('table-search');
		input.setAttribute('type', 'text');
		input.classList.add('form-control');
		input.setAttribute('placeholder', 'Type to search');

		this.activateSearch(input);

		search.appendChild(input);

		this.#table.parentElement.prepend(search);
	}

	/**
	 * Activate the search bar by adding the event handler
	 * @param {*} input
	 */
	activateSearch(input) {
		const table = this.#table;
		input.addEventListener('keyup', function () {
			const rows = table.querySelectorAll(`tbody tr:not([class*='extra-info'])`);
			rows.forEach((row) => {
				if (row.innerHTML.toLowerCase().includes(this.value.toLowerCase())) {
					row.classList.remove('hide');
				} else {
					row.classList.add('hide');
				}
			});
		});
	}

	/**
	 * Initialize pagination
	 */
	initializePages(number) {
		if (!this.options.paginate) {
			return undefined;
		}

		this.options.pageCount = number || 10;

		const tbody = this.#table.querySelector('tbody');
		const rows = tbody.querySelectorAll(`tr:not([class*='extra-info'])`);
		const length = Math.ceil(rows.length / this.options.pageCount);

		const span = document.createElement('span');
		for (let i = 0; i < length; i += 1) {
			let a = document.createElement('a');
			a.innerHTML = i + 1;
			a.classList.add('paginate_button');
			span.appendChild(a);
		}

		this.pagination.innerHTML = '';
		this.pagination.appendChild(span);

		this.paginateTable();
	}

	/**
	 * PaginateTable: restricts the number of items in the
	 * table according to configured page length
	 */
	paginateTable() {
		const table = this.#table;
		const rows = table.querySelectorAll(`tbody tr:not([class*='extra-info'])`);
		this.#elemCount = rows.length;

		rows.forEach((row, index) => {
			if (index > this.options.pageCount) {
				row.classList.add('hide');
			}
		});

		this.pagination.querySelectorAll('a').forEach((btn, index) => {
			btn.addEventListener('click', () => {
				this.navigatePage(index + 1);
				// console.log(this);
			});
		});
		this.navigatePage(1);
	}

	/**
	 * NavigatePage
	 */
	navigatePage(page) {
		const restrictCount = this.options.pageCount * page;
		const tbody = this.tbody;
		tbody.querySelectorAll(`tr:not([class*='extra-info'])`).forEach((row, index) => {
			if (index < restrictCount && index > restrictCount - this.options.pageCount - 1) {
				// console.log(index);
				row.classList.remove('hide');
			} else {
				row.classList.add('hide');
			}
		});

		let text = `Showing ${restrictCount + 1 - this.options.pageCount} - ${restrictCount} of ${this.#elemCount}`;
		if (page === this.pagination.querySelectorAll('a').length) {
			text = `Showing ${restrictCount + 1 - this.options.pageCount} - ${this.#elemCount} of ${this.#elemCount}`;
		}
		this.infoDiv.innerHTML = text;

		this.pagination.querySelectorAll('a').forEach((a, i) => {
			a.classList.remove('active');
			if (page - 1 === i) {
				a.classList.add('active');
			}
		});
		// btn.classList.add('active');
	}

	/**
	 * LoadData: load json data over a fetch request
	 * @async
	 * @param {string} url - Url where get request is made to
	 * @function callback - callback function to execute after request is made
	 */
	async loadData(options) {
		try {
			const res = await fetch(options.url);
			const data = await res.json();

			let text = options.successCallback(data);
			this.#loadedData = text;
			this.initTable();
			if (options.paginate) {
				this.initializePages();
			}
		} catch (error) {
			options.failureCallback(error);
		}
	}

	fillLoadData() {
		this.tbody.innerHTML = this.#loadedData;
	}

	/**
	 * Getter: get tbody value
	 */
	get tbody() {
		return this.#table.querySelector('tbody');
	}
}

export default Table;
