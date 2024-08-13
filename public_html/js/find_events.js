let currentPage = 1;

$(document).ready(function() {
    loadEvents();

    $('#search-bar, #category-filter, #date-filter').on('input change', function() {
        currentPage = 1; // Reset to the first page for new searches
        loadEvents(true); // Load events with reset
    });

    $(document).on('click', '.pagination-link', function(e) {
        e.preventDefault();
        currentPage = $(this).data('page');
        loadEvents();
    });
});

function loadEvents(reset = false) {
    const searchQuery = $('#search-bar').val();
    const category = $('#category-filter').val();
    const date = $('#date-filter').val();

    if (reset) {
        $('#events-container').empty(); // Clear existing events
    }

    $.ajax({
        url: '/EventVersee/public_html/events/load_events.php',
        method: 'GET',
        data: {
            search: searchQuery,
            category: category,
            date: date,
            page: currentPage
        },
        success: function(response) {
            const data = JSON.parse(response);
            $('#events-container').html(data.events);
            $('#pagination').html(data.pagination);
        },
        error: function(xhr, status, error) {
            console.error('Error loading events:', error);
        }
    });
}
