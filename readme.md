# **Events Manager in PHP**
##### *Author: Tom Hanover*
##### *Last Updated: 08.15.2018*
---

## Table of Contents:
1. [Project Purpose](#1.-project-purpose)
2. [Application Overview](#2.-application-overview)
3. [Setting-up and Running the Application](#3.-setting-up-and-running-the-application)
4. [REST APIs](#4.-REST-APIs)

---

## 1. Project Purpose
- Original build of a Web application in PHP and MySQL to manage events (parties, festivals, tournaments, meetings, etc.)
- Used to manage event's details as well as invites to participants

## 2. Application Overview

### 2.1 Application Features
- Admins
    - Admin can create, edit and delete an event
    - Admin can send and revoke invites to users
    - Admin can add and delete users
- Users
    - Users can see the events they are invited to including the status of the invite
    - Users can also change their previous response (i.e. accept to decline, or decline to accept)

### 2.2 Application Source Code Structure
  - `Index.php` - Main controller. Handles all incoming actions, besides REST API calls
  - `Rest.php` - Handles REST API calls (see section 4)
  - `./view/` - all of the views that the application uses
    - `header.php` - contains the html header information. This is included in every other view.
    - `footer.php` - contains the html footer information. This is included in every other view.
    - `event_list.php` - handles which event list to show. This is the view that is called by default when a user first signs in
    - `admin_event_list.php` - is used when event_list.php sees that the user is the admin. This will list all of the events in the database along with the option for the user to edit the events
    - `admin_menu.php` - this is called by header.php when it sees that the user is the admin
    - `add_event.php` - view for adding a new events
    - `edit_event.php` - view that gives all of the information for an event and allows the admin to edit the information and who is invited
    - `get_user.php` - this presents a view that has the user select a user to log-in as
    - `user_list.php` - lists the users for the admin. Also gives a form that the admin can use to add a new user
    - `user_menu.php` - this is called by header.php when it sees that the user is a general user (i.e. not an admin)
    - `user_event_list.php` - show the events that the user is invited to, has accepted, or that they have declined
  - `./model/` - all of the php files that hanles access the database and returning the data back to the controller (index.php)
    - `database.php` - creates the connection to the database
    - `events_db.php` - handles queries to the events table
    - `invites_db.php` - handles queries to the invites table
    - `users_db.php` - handles queries to the users table
    - `database_error.php` - view that gives the user information if the database issues an error
    - `events_db.sql` - SQL commands that can be used to set up the tables and rows in the tables for first use


### 2.3 Database Structure
  - MySQL Database
  - Name: `events-db`
  - Table: `events` - stores the details of the events
    - Field: `eventID`: unique ID for the event
    - Field: `eventTitle`: short name of the event
    - Field: `eventDate`: date of the event
    - Field: `eventDesc`: description of the event
  - Table: `users` - stores the details for each user
    - Field: `userID`: unique ID for the user
    - Field: `userFirstName`: first name of the user
    - Field: userLastName: last name of the user
    - Field: userEmail: email for the user
  - Table: `invites` - keeps track of invites to a user for a given event
    - Field: `eventID`: foreign key to same name in *events* table
    - Field: `userID`: foreign key to same name in *users* table
    - Field: `status`: text to indicate the status of the invite including:
      - `invited` - an invite has been created for the user, but they have not responded yet
      - `accepted` - a user has indicated they plan to attend and accepted the invite
      - `declined` - a user has indicated they don't plan to attend and has declined the invite

## 3. Setting-up and Running the Application
1. Place the whole unzipped file in the htdocs folder
2. To establish the database, you can either edit the `./model/database.php` file with you own database name and user, or set-up mySQL with the following:
3. Create a database named: `events-db`
4. Create a user with read and write permissions to the `events-db` database with `username=cs602_user` and `password=cs602_secret`
5. Access phpmyadmin to run all of the SQL in `events_db.sql`
6. Access the webserver at: http://localhost:8888/CS602_Final_Project_Hanover or http://localhost/CS602_Final_Project_Hanover

## 4. REST APIs
The application will support the following REST API calls:

1. List all of the users in the application:
    - XML
      - `/rest.php?format=xml&action=users`
    - JSON
      - `/rest.php?format=json&action=users`
2. List all of the events in the application:
    - XML
      - `/rest.php?format=xml&action=events`
    - JSON
      - `/rest.php?format=json&action=events`
3. List the invites and the status for an event
    - XML
      - `/rest.php?format=xml&action=invites&event=eventID` where `eventID` is a valid event's ID
    - JSON
      - `/rest.php?format=json&action=invites&event=eventID` where `eventID` is a valid event's ID

