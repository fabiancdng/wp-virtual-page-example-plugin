<?php
/**
 * Template Name: My Virtual Page
 */

// Include WordPress header (if you want to).
get_header();

// Get the ticket ID from our query var.
// You can call a filter/function here to get the data for the ticket.
$ticket_id = get_query_var( 'ticket-id' );

// HTML output here.
// For demonstration purposes, I only output the ticket ID here.
echo $ticket_id;

// Include WordPress footer (if you want to).
get_footer();