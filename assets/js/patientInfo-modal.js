document.addEventListener('DOMContentLoaded', function() {
    // Tab handling
    const medicalLinks = document.querySelectorAll('.nav-link.medical');
    
    medicalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links and tab panes
            medicalLinks.forEach(navLink => {
                navLink.classList.remove('active');
            });
            
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active', 'show');
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Get the target tab from href and activate it
            const tabId = this.getAttribute('href');
            const targetTab = document.querySelector(tabId);
            if (targetTab) {
                targetTab.classList.add('active', 'show');
            }
        });
    });

    // Modal handling
    const displayModal = document.getElementById('displayModal');
    let bsModal = null;

    async function getInfo() {
        try {
            const response = await fetch('../../functions/manage_patient/display_info.inc.php');
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            const data = await response.json();
            console.log(data);
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
        }
    };
});