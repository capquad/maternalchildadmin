$(() => {
	const openNavBtn = $('#openNav');
	openNavBtn.on('click', openNav);
	$('#closeNav').on('click', closeNav);
	initsideBar();

	const submitForm = async (form, options) => {
		const action = form.action;
		const formData = new FormData(form);

		let defOptions = {
			method: 'POST',
			body: formData,
		};
		if (options) defOptions = [defOptions, ...options];

		try {
			const res = await fetch(action, defOptions);
			const data = await res.json();
			if (data.ok) {
				location.href = form.getAttribute('data-redirect') || '/';
			} else {
				console.log(data);
			}
		} catch (err) {
			console.error(err);
		}
	};

	document.querySelectorAll('.async-form').forEach((form) => {
		form.addEventListener('submit', async function (e) {
			e.preventDefault();
			await submitForm(this);
		});
	});
});

function openNav() {
	const sideBar = $('#sidebar');
	// console.log(sideBar);
	sideBar.css('display', 'initial');
	sideBar.addClass('sidebar-open');
}

function closeNav() {
	const sideBar = $('#sidebar');
	// console.log(sideBar);
	sideBar.css('display', 'none');
	sideBar.removeClass('sidebar-open');
}

function initsideBar() {
	if ($(window).width() > 480) {
		openNav();
	}
}
