# pavonChat

### A messaging application that enables real-time communication between users. It offers a user-friendly and secure interface where users can sign up, log in, and connect with others to exchange messages seamlessly.

<div align="center" style="margin: 30px;">
  <img src="docuResources/logo.png" alt="Descripción de la imagen" width="400">
</div>

#### The goal of this project is to build a complete messaging application using only MySQL and vanilla PHP, without relying on any frameworks. The application will enable users to send messages to other people efficiently.

## How to develop

This development is ready to deploy, meaning that if you want to run it on a server, it's as simple as cloning the repository on a Linux server or machine with Docker installed.

To deploy the application, you only need to clone the repository and run the following command:

```$ sudo bash deployChat.sh```

<div align="center" style="margin: 30px;">
  <img src="docuResources/docker.png" alt="Descripción de la imagen" width="700">
</div>

## Documentation

### Classes

This application has three core classes: one for users, another for contacts, and another for messages. Each class manages its own database connections. This way, if we ever change the database system, the code remains unaffected.

There is a generic class called DB, which is a dependency for each core class. The DB class handles the connection to any of the tables. This approach makes everything much more modular and independent.

### Users

In the users table, we store several pieces of information: the user ID, the username or phone number, their password, and their avatar.

One of the additional features I wanted to add is that passwords are stored fully encrypted. This way, we ensure that the connection is always secure and that no sensitive data is stored.

<div align="center" style="margin: 30px;">
  <img src="docuResources/signIn.png" alt="Descripción de la imagen" width="400">
</div>

### Contacts

When a user wants to send messages to another, they first need to add them to the contacts table. The contacts table will store the contact's first name, last name, username or phone number, the avatar assigned to the user, and the ID of the user who adds the new contact.

Both the ID of the user who adds and the phone number are foreign keys. This ensures that the user being added exists in the users database. This way, we can manage the messaging section between users more easily.

<div align="center" style="margin: 30px;">
  <img src="docuResources/contact.png" alt="Descripción de la imagen" width="600">
</div>

### Messages

When a user has a contact added, they can send them messages. In the message class, we store the message ID, the sender's ID, the receiver's ID, the date the message is sent (which is automatically set), and the message content.

<div align="center" style="margin: 30px;">
  <img src="docuResources/chat.png" alt="Descripción de la imagen" width="600">
</div>

If you want to see the database structure, here's a small example.

<div align="center" style="margin: 30px;">
  <img src="docuResources/DB.png" alt="Descripción de la imagen" width="800">
</div>