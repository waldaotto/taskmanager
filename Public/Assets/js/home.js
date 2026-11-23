
document.addEventListener('DOMContentLoaded', () => {

    const elements = document.querySelectorAll('[data-reveal]');

    // Verifica suporte à animação por observação.
    if (!('IntersectionObserver' in window)) {
        elements.forEach(element => {
            element.classList.add('visible');
        });

        return;
    }

    const observer = new IntersectionObserver((entries, observer) => {

        entries.forEach(entry => {

            if (entry.isIntersecting) {
                entry.target.classList.add('visible');

                observer.unobserve(entry.target);
            }

        });

    }, {
        threshold: 0.12,
        rootMargin: '0px 0px -35px 0px'
    });

    elements.forEach(element => {
        observer.observe(element);
    });

});
