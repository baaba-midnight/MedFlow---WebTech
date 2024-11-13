document.addEventListener('DOMContentLoaded', function() {
    const navLinks = document.querySelectorAll('.nav-link');

    // add click event listener to each nav link
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();

            // remove active class from all links and tab panes
            navLinks.forEach(navLink => {
                navLink.classList.remove('active');
            });

            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active');
                pane.classList.add('fade');
            });

            // add active class to clicked link
            this.classList.add('active');

            // get the target tab from href and activate it
            const tabId = this.getAttribute('href');
            const targetTab = document.querySelector(tabId);
            targetTab.classList.remove('fade');
            targetTab.classList.add('active');
        });
    });
});