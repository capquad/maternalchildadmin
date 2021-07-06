$(() => {
	const openNavBtn = $('#openNav');
	openNavBtn.on('click', openNav);
	$('#closeNav').on('click', closeNav);
	initsideBar();
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
