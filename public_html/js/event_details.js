$(document).ready(function() {
    function showLoginPrompt() {
        alert("Please login to RSVP for this event.");
        window.location.href = "/EventVersee/public_html/login/login.php";
    }

    function rsvpEvent(eventId) {
        $.ajax({
            url: '/EventVersee/public_html/events/rsvp_event.php',
            method: 'POST',
            data: {
                event_id: eventId
            },
            success: function(response) {
                try {
                    const result = JSON.parse(response);
                    alert(result.message);
                    if (result.status === 'success') {
                        $('#rsvp-button').hide();
                        $('#unrsvp-button').show();
                    }
                } catch (e) {
                    console.error("Error parsing JSON:", e);
                }
            },
            error: function(xhr, status, error) {
                console.error("Error: " + error);
            }
        });
    }

    function unrsvpEvent(eventId) {
        if (confirm("Are you sure you want to cancel your RSVP?")) {
            $.ajax({
                url: '/EventVersee/public_html/events/unrsvp_event.php',
                method: 'POST',
                data: {
                    event_id: eventId
                },
                success: function(response) {
                    try {
                        const result = JSON.parse(response);
                        alert(result.message);
                        if (result.status === 'success') {
                            $('#rsvp-button').show();
                            $('#unrsvp-button').hide();
                        }
                    } catch (e) {
                        console.error("Error parsing JSON:", e);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });
        }
    }

    // Event listeners
    $('#loginPrompt').click(function() {
        showLoginPrompt();
    });

    $('#rsvp-button').click(function() {
        const eventId = $(this).data('event-id');
        rsvpEvent(eventId);
    });

    $('#unrsvp-button').click(function() {
        const eventId = $(this).data('event-id');
        unrsvpEvent(eventId);
    });

    if (new URLSearchParams(window.location.search).has('rsvp') && new URLSearchParams(window.location.search).get('rsvp') === 'success') {
        $('#rsvpModal').show();
    }

    $('.close').click(function() {
        $(this).parent().parent().hide();
    });

    $(window).click(function(event) {
        if ($(event.target).hasClass('modal')) {
            $(event.target).hide();
        }
    });
});
