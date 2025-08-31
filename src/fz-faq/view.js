document.addEventListener('DOMContentLoaded', () => {
	let blocks = document.querySelectorAll('.js-faq-block');

	blocks.forEach(block => {
		let questions = block.querySelectorAll('dt');

		questions.forEach(dt => {
			dt.addEventListener('click', () => {
				let isOpen = dt.classList.contains('selected');

				questions.forEach(q => {
					q.classList.remove('selected');
				});

				if (!isOpen) {
					dt.classList.add('selected');
				}

			});
		});
	});
});
