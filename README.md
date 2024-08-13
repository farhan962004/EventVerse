# EventVerse

**EventVerse** is a one-stop event management platform designed to simplify event hosting and participation. It offers tools for organizers to efficiently manage events and provides attendees with an easy-to-navigate interface to discover and register for events.

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [File Structure](#file-structure)
- [Installation Instructions](#installation-instructions)
- [Security Features](#security-features)
- [Test User Credentials](#test-user-credentials)


## Project Overview

EventVerse is a minimalistic and powerful platform aimed at streamlining the event management process. Organizers can create and promote events, manage registrations, and handle logistics, while attendees can easily discover and register for events that match their interests.

## Features

- **Homepage:** Browse and filter events by categories.
- **Find Events:** Search for events using keywords, date, and type filters.
- **Host an Event:** Create detailed event listings with an intuitive form.
- **My Bookings:** View a list of events the user has RSVP'd for.
- **Admin Panel:** Manage users, events, and admin privileges.
- **Contact Us:** Provide feedback and contact the platform administrators.

## File Structure

All project files are organized into directories for easy access and maintenance:

EventVerse/
.vscode/ # Configuration files
private/ # PHP files for config and database setup
public_html/
index.php # Main entry point
admin/ # Admin-related PHP files
css/ # CSS files for styling
events/ # Event-related PHP files
images/ # Image files
js/ # JavaScript files
login/ # Login and signup PHP files
templates/ # Template PHP files
uploads/ # Uploaded image files
user/ # User-related PHP files

## Installation Instructions

1. **Upload Files:**
   - Upload the EventVerse project files to your server, maintaining the directory structure.

2. **Set Database Credentials:**
   - Update `db.php` in the `private` directory with your database credentials.

3. **Set Permissions:**
   - Set directory and file permissions:
     ```
     chmod -R 755 /path/EventVerse
     chmod 644 /path/EventVerse/private/db.php
     ```

4. **Test Database Connection:**
   - Navigate to `private/test_db.php` to ensure the database connection is successful.

5. **Set Up the Database:**
   - Access `private/install.php` to set up the database tables.

## Security Features

- **Field Validation:** Client-side (JavaScript) and server-side (PHP) validation.
- **Protection Against SQL Injection:** Use of prepared statements and input escaping.
- **Password Security:** Passwords are hashed using PHP’s `password_hash()` function.
- **Session Management:** Secure session handling with validation on each request.
- **Input Sanitization:** Prevention of XSS attacks using `htmlspecialchars()`.
- **File Upload Security:** Validation of file types and sizes.

## Test User Credentials

- **Admin Access:**
  - Username: `admin@admin.com`
  - Password: `Admin@123`

- **User Access:**
  - Username: `Test@123.com`
  - Password: `Test@123`


