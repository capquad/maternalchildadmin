String.prototype.capitalize = function () {
	return this.charAt(0).toUpperCase() + this.slice(1);
};

async function getPatientNumber(category = "personal") {
	try {
		const res = await fetch(
			"/api/patients.php?getNewNumber&category=" + category
		);
		const data = await res.json();
		if (data.ok) {
			return data.data["card-number"];
		} else {
			console.log(data);
		}
	} catch (err) {
		console.error(err);
	}
}