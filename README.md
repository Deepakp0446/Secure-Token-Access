# Secure Token Access System

## Introduction
The Secure Token Access System is a robust authentication and authorization solution designed to provide secure access to protected resources within a web application. It offers token-based authentication, token generation and validation, and phone number verification for enhanced security and user authentication.

## Features
- User registration with Username, password, phone number and email
- User login with secure token generation
- Token validation for access control
- Phone number verification using Voice call OTP
- Real-time chat room integration for users communication

## Installation
To install and run the Secure Token Access System locally, follow these steps:
1. Clone the repository to your local machine.
2. Install Xampp server goto folder (xampp->htdoc->paste this file) .
3. Set up a database using MySQL file (auth.sql).
4. Start the server: Apache Admin and MySQL Admin on pannel of xampp server
5. Access the application in your web browser at http://localhost/aut

## Usage
Once the Secure Token Access System is set up and running, users can perform the following actions:
- Register for an account using their username and password.
- Log in to their account securely using the generated token.
- Access protected resources by providing a valid token.
- Verify their phone number through OTP for added security.
- Engage in real-time communication with other users in chat room.

## Technologies Used
- HTML
- CSS
- js
- PHP
- MySql
- FireBase (storing Chats on Database)
- 2Factor.in OTP service provider

## Limitations
- Currently, the system only supports Username and password-based registration and login. Additional authentication methods may be implemented in future updates.
- Phone number verification is reliant on external services such as Twilio, which may incur additional costs or dependencies. but I use factor.in
- 
## Future Enhancements
- Implementation of additional authentication methods such as OAuth, Google Sign-In, or social media authentication.
- Integration of additional security features such as CAPTCHA verification or IP address blocking for enhanced protection against malicious attacks.
- Enhancement of chat room functionality with features such as file sharing, message encryption, and user roles.

## Contributors
- Deepak Prajapati - Project Manager, Lead Developer and Project Developer
