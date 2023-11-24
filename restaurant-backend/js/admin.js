document.addEventListener('DOMContentLoaded', function () {
    // Retrieve the active tab from local storage
    let activeTab = localStorage.getItem('activeTab');

    // Set the active tab if it exists
    if (activeTab) {
        let tabLink = document.querySelector('a[data-bs-target="' + activeTab + '"]');
        if (tabLink) {
            new bootstrap.Tab(tabLink).show();
        }
    }

    // Listen for tab change events
    let tabs = document.querySelectorAll('.nav-link[data-bs-toggle="tab"]');
    tabs.forEach(function (tab) {
        tab.addEventListener('shown.bs.tab', function (event) {
            // Store the active tab in local storage
            let targetTab = event.target.getAttribute('data-bs-target');
            localStorage.setItem('activeTab', targetTab);
        });
    });
});