Secure Digital Ark
Secure Digital Ark is a lightweight PHP-based file management application that allows users to upload and download files securely. It supports individual file protection with passwords and group-based access control. It’s ideal for teams, organizations, or individuals who need to share files with layered security, all stored locally.
************************************************

Features :

Password-Protected Uploads (per file or by group)

Local File Storage using a structured directory (uploads/)

Metadata Management via metadata.json

Group Password Verification using hashed credentials

User-Friendly Interface built with Bootstrap 5 & CSS

Download Restrictions for unauthorized access

File Type and Size Validation

Responsive Design with a clean UI

Technologies Used
PHP 8+

HTML5 + Bootstrap 5

JSON for data storage

CSS for custom styling

No Database Required

************************************************

 Project Structure

secure-digital-ark/
├── assets/
│   └── style.css             # Custom CSS styles
├── data/
│   ├── metadata.json         # Stores metadata for each file
│   └── group-passwords.json  # Stores hashed group passwords
├── uploads/                  # Stores all uploaded files
├── index.php                 # Main upload form
├── list.php                  # Displays list of uploaded files
├── upload.php                # Handles file uploads
├── download.php              # Handles password check + downloads
├── check-group-passwords.php # Verifies group passwords
└── README.md
Security Highlights
Passwords: All passwords (individual and group) are hashed using password_hash() (bcrypt).

Verification: Passwords are verified via password_verify() to prevent brute-force attacks.

File Validation:

Maximum size: 10 MB

Allowed types: .jpeg, .png, .pdf, .zip, .txt

Overwrite Protection: Rejects file uploads with existing filenames.
************************************************

Upload Process: 

Go to index.php

Choose a file to upload.

(Optional) Set:

A password for individual access.

A group name for group-based access (must exist in group-passwords.json)

Click Upload.

View or download uploaded files from list.php.
************************************************

Download Process: 

Go to list.php

Find the file you want to download.

If it's protected:

Enter the required password.

Click Download.

The system checks:

If the file exists

If the metadata matches

If the password (individual or group) is valid

🧱 Group Access (Advanced)
Groups are defined in data/group-passwords.json. Example:

{
  "admins": "$2y$10$hash...",
  "students": "$2y$10$hash...",
  "research": "$2y$10$hash..."
}
To generate a new group password:

echo password_hash("yourGroupPassword", PASSWORD_DEFAULT);
Add the result to group-passwords.json.
************************************************

🎨 UI/UX
Clean design with responsive layout

Alerts for:

Success messages

Errors (invalid format, file too big, duplicate, etc.)

Buttons styled with Bootstrap (btn-primary, btn-secondary, btn-danger)

Password input styling is consistent across forms
************************************************

 How to Run Locally Using XAMPP :

Prerequisites
XAMPP installed on your system

Basic knowledge of how to run PHP applications locally

Steps:
Start Apache via XAMPP

Open XAMPP Control Panel and click Start next to Apache.

Clone or Copy Project Folder

Copy the full project folder (secure-digital-ark) into:


C:\xampp\htdocs\
The full path should be:


C:\xampp\htdocs\secure-digital-ark\
Launch in Browser

Open your browser and go to:


http://localhost/secure-digital-ark/index.php
Test File Uploads

Upload a file with or without a password.

Optionally assign the file to a group (e.g., "admins", "research", or "students").

View uploaded files via "View Uploaded Files" button.

Test file downloads with correct or incorrect password input.

************************************************

Author:
Hamideh Rahmani
Project: Secure Digital Ark

