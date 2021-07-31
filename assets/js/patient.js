(() => {
	document.addEventListener("DOMContentLoaded", () => {
		const checkinBtn = document.querySelector("#check-in");
		// console.log(checkinBtn);
		checkinBtn.addEventListener("click", async function () {
			// console.log(this.getAttribute("data-info"));
			try {
        const res = await fetch('/api/patients.php')
			} catch (err) {}
		});
	});
})();
