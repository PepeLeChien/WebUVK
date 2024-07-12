document.addEventListener('DOMContentLoaded', function() {
    handleScrollHeader();
    setupToggleContent();
    setupRadioChange();
});

function handleScrollHeader() {
    window.addEventListener('scroll', function() {
        const header = document.querySelector('.header');
        if (window.scrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });
}

function setupToggleContent() {
    document.querySelectorAll('.toggle-title').forEach(item => {
        item.addEventListener('click', function() {
            const content = this.nextElementSibling;

            if (content.style.maxHeight) {
                content.style.maxHeight = null;
                this.classList.remove('open');
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
                this.classList.add('open');
            }
        });
    });
}

function setupRadioChange() {
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('input[type="radio"]').forEach(r => {
                r.nextElementSibling.style.color = ''; // Reset color
            });
            this.nextElementSibling.style.color = '#F4B401'; // Change color of selected
        });
    });
}

