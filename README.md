Question

Objective: Create a mini Event Management System in Drupal that allows users to create and manage events, display upcoming events, and register for events. This task will test your abilities in theming, form creation, hooks, custom module development, views, custom entity creation, and custom block creation.

Requirements:

Custom Entity Creation:

Create a custom entity type called Event.
Fields for Event should include:
Event Name (text)
Event Description (long text)
Event Date (datetime)
Event Location (text)
Custom Module Development:

Develop a custom module named event_manager.
This module should handle the custom entity creation, form submission, and custom hooks.

Form Creation:

Create a form for adding new events. This form should be accessible via /add-event.
Ensure validation for required fields and proper date format.

Hook Implementation:

Implement a hook to perform actions after an event is created (e.g., send a confirmation email to the site admin).

Views:

Create a view that lists all upcoming events.
The view should be displayed on a custom page /upcoming-events.
Use filters to show only future events based on the current date.

Custom Block Creation:

Create a custom block that displays the next upcoming event.
Place this block in a region on the site (e.g., sidebar).

Small Theming:

Customize the display of the event nodes using a theme template.
Ensure that the event details (name, description, date, and location) are styled according to the site’s theme.

Deliverables:

A fully functional event_manager module with the following:

Code for custom entity creation.
Custom form code with validation and submission handling.
Implementation of a hook to send an email upon event creation.
A view configuration to list upcoming events.

A custom block to display the next upcoming event.

Theming templates and CSS for the event node display.

Instructions:

Custom Entity Creation:

Create the Event entity type using Drupal's Entity API.
Ensure the entity type is exportable and follows best practices for Drupal coding standards.

Form Creation:

Define a form class that implements the form interface.
Include form validation and submission handlers.

Hook Implementation:

Use hook_ENTITY_TYPE_insert() to send an email after an event is created.

Views and Blocks:

Create and configure the view for upcoming events.
Define a custom block plugin to display the next event.

Theming:

Create a Twig template for the event node.
Apply CSS to ensure the event details are styled consistently with the site’s theme.

Testing:

Test all functionalities to ensure they work as expected.
Document any issues and how they were resolved.
