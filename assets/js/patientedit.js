(() => {
	function toggleElement() {
		const target = this.getAttribute('data-target');
		const property = this.getAttribute('data-property');

		const elem = document.querySelector(target);

		if (elem.hasAttribute(property)) {
			elem.removeAttribute(property);
		} else {
			elem.setAttribute(property, true);
		}
	}

	window.addEventListener('load', () => {
		try {
			const toggleAbles = document.querySelectorAll('form button[data-property]');
			toggleAbles.forEach((btn) => {
				btn.addEventListener('click', toggleElement);
			});
		} catch (err) {
			console.log(err);
		}
	});

	window.addEventListener('load', () => {
		try {
			const fGender = document.querySelector('#f-gender');
			fGender.addEventListener('change', function () {
				const value = this.value;
				document.querySelector('#gender').value = value;
			});
		} catch (err) {}
	});

	window.addEventListener('load', () => {
		const false9s = document.querySelectorAll('[data-origin]');
		false9s.forEach((false9) => {
			false9.addEventListener('change', function () {
				const target = document.querySelector(this.getAttribute('data-origin'));
				target.value = this.value;
			});
		});
	});
})();
