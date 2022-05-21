const open = document.getElementById('video_modal_open');
const close = document.getElementById('video_modal_close');
const modal = document.getElementById('video_modal_container');

if ( document.getElementById('video_modal_open') ) {
	open.addEventListener('click', () => {
		modal.classList.add('show');
	});
}

if ( document.getElementById('video_modal_close') ) {
	close.addEventListener('click', () => {
		modal.classList.remove('show');
	});
}
