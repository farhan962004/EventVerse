# EventVerse

[![Live Website](https://img.shields.io/badge/Live%20Website-View%20Now-brightgreen)](https://comp3340.khan2g1.myweb.cs.uwindsor.ca/EventVersee/public_html/)

**EventVerse** is a comprehensive event management platform designed to streamline the process of hosting and attending events. Whether you're an event organizer or an attendee, EventVerse offers an intuitive interface and powerful tools to make event management a breeze.

## Table of Contents

- [Project Overview](#project-overview)
- [Features](#features)
- [File Structure](#file-structure)
- [Installation Instructions](#installation-instructions)
- [Security Features](#security-features)
- [Test User Credentials](#test-user-credentials)

## Project Overview

EventVerse is built with simplicity and efficiency in mind. The platform allows event organizers to create, promote, and manage events effortlessly, while attendees can easily discover and register for events that match their interests. The live version of the website can be accessed [here](https://comp3340.khan2g1.myweb.cs.uwindsor.ca/EventVersee/public_html/).

## Features

### For Event Attendees
- **Browse Events:** Easily find events by category, date, or keyword.
- **RSVP:** Register for events with just a few clicks.
- **Personalized Experience:** Get recommendations based on your interests.

### For Event Organizers
- **Create Events:** Use a simple form to create and manage events.
- **Manage Registrations:** Keep track of attendees and manage logistics.
- **Promote Events:** Reach a wider audience through integrated promotion tools.

### For Administrators
- **User Management:** View, edit, and remove users from the platform.
- **Event Management:** Control the events listed on the platform.
- **Admin Management:** Manage privileges of other administrators.

## File Structure

The project is organized into directories to ensure maintainability and ease of access:

\`\`\`plaintext
EventVerse/
├── .vscode/                  # Configuration files
├── private/                  # PHP files for config and database setup
├── public_html/
│   ├── index.php             # Main entry point
│   ├── admin/                # Admin-related PHP files
│   ├── css/                  # CSS files for styling
│   ├── events/               # Event-related PHP files
│   ├── images/               # Image files
│   ├── js/                   # JavaScript files
│   ├── login/                # Login and signup PHP files
│   ├── templates/            # Template PHP files
│   ├── uploads/              # Uploaded image files
│   └── user/                 # User-related PHP files
\`\`\`

## Installation Instructions

To get EventVerse up and running on your own server, follow these steps:

1. **Upload Files:**
   - Upload the EventVerse project files to your server, ensuring the directory structure is preserved.

2. **Set Database Credentials:**
   - Open \`db.php\` in the \`private\` directory and enter your database credentials.

3. **Set Permissions:**
   - Set the appropriate permissions for directories and files:
     \`\`\`bash
     chmod -R 755 /path/EventVerse
     chmod 644 /path/EventVerse/private/db.php
     \`\`\`

4. **Test Database Connection:**
   - Verify the database connection by navigating to:
     \`https://yourdomain.com/EventVerse/private/test_db.php\`

5. **Set Up the Database:**
   - Complete the database setup by accessing:
     \`https://yourdomain.com/EventVerse/private/install.php\`

## Security Features

EventVerse is built with robust security measures to protect both organizers and attendees:

- **Field Validation:** Both client-side (JavaScript) and server-side (PHP) validations ensure data integrity.
- **SQL Injection Protection:** Prepared statements and input escaping are used to prevent SQL injection.
- **Password Security:** Passwords are hashed using PHP’s \`password_hash()\` function.
- **Session Management:** Secure session handling with validation on each request.
- **Input Sanitization:** Prevents XSS attacks using \`htmlspecialchars()\`.
- **File Upload Security:** Uploaded files are validated for type and size restrictions.

## Test User Credentials

Use the following credentials to explore the platform:

- **Admin Access:**
  - Username: \`admin@admin.com\`
  - Password: \`Admin@123\`

- **User Access:**
  - Username: \`Test@123.com\`
  - Password: \`Test@123\`
