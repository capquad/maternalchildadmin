(() => {
	async function getPatientNumber(category = 'personal') {
		try {
			const res = await fetch('http://127.0.0.1:8000/api/patients.php?getNewNumber&category=' + category);
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
})();
