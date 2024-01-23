# Dorm Res Readme

## Introduction

Welcome to the Dormitory Room Reservation System, a robust web application designed to streamline the process of reserving rooms in university dormitories. Built using Docker containers, PostgreSQL as the database management system, and featuring a well-defined Entity-Relationship Diagram (ERD), this system ensures a seamless and efficient experience for both users and administrators.

## Docker Containers

In the Dormitory Room Reservation System project, we utilize several Docker containers to provide a comprehensive runtime environment.

1. **nginx:** Container containing the Nginx HTTP server, responsible for serving static files and acting as a reverse proxy for the PHP application.

2. **php:** Container housing the PHP interpreter to handle the business logic in our web application.

3. **postgres:** Container holding the PostgreSQL database, used for storing reservation and user data.

4. **pgadmin4:** Container incorporating the pgAdmin 4 tool, allowing for the management of the PostgreSQL database through a graphical interface.

## Features
### Login
The login screen includes an option to navigate to the registration screen.
1. Users can log in to their accounts using their email and password.

2. The system verifies the entered credentials against the stored database records.
   
3. Upon successful authentication, users are redirected to the main system page.

![logowanie](https://github.com/kubas8111/DormRes/assets/80070461/3c68a68c-74e3-40b0-9530-e934f17115ae)

### Register
The register screen includes an option to navigate to the login screen.
1. Users can register for an account by providing their information.

2. The system checks if the provided email is unique and not already registered.

3. If the email is unique, the system adds the user to the database.

4. After successful registration, users are redirected to the login page.

![rejestracja](https://github.com/kubas8111/DormRes/assets/80070461/6df9bfd9-a14c-45aa-845a-93bd331e477c)

### Main Dashboard
The main dashboard provides essential options for users after successful login.

- Users can log out from their accounts.

- Users can navigate to the following pages:
  - Reserve: Allows users to make room reservations.
  - Check Reservation: Displays information about the user's reservations.
  - Dormitory Information: Provides details about university dormitories.

![main](https://github.com/kubas8111/DormRes/assets/80070461/35655729-5b6a-40a1-a044-a865b182c09a)

### Room reservation

Users can access the reservation page to make room reservations.

The page includes a form with two dropdowns (selects).

1. The first dropdown allows users to choose a dormitory.

2. The second dropdown fetches and displays available rooms based on the selected dormitory.

3. Users submit the form to reserve a room.

If a user already has a reservation, a message informs them that they cannot make additional reservations.

![rezerwacja](https://github.com/kubas8111/DormRes/assets/80070461/fb9e37a7-1e0b-4954-9740-99a1caf11245)

### Check Reservation

- Users can access the "Check Reservation" page to view information about their room reservation.

- If the user has an active reservation, details about the reservation are displayed.

- Users with an active reservation have the option to cancel it.

- If the user does not have a reservation, a message informs them that no reservation is currently on record.

![zarezerwowany](https://github.com/kubas8111/DormRes/assets/80070461/c1912728-d04b-4563-b34f-b60c9b1fe0b3)

### Admin Dashboard

- Upon logging in as an admin, additional options become available in the dashboard.

- Admins can access the "User Management" and "Reservation Overview" pages to view information about users and reservations, respectively.

![lista_uzytkownikow](https://github.com/kubas8111/DormRes/assets/80070461/b64a5d4f-35c1-45a3-8808-27a5449731d8)

## ERD Diagram
![DiagramERD](https://github.com/kubas8111/DormRes/assets/80070461/18e4bb33-b517-41c5-abf3-f932789649c2)


## Quick Start

1. Clone the Repository:
  ```bash
  git clone https://github.com/kubas8111/DormRes.git
  ```

2.Navigate to the Project Directory:
  ```bash
  cd DormRes
  ```

3. Run Docker Compose:
  ```bash
  docker-compose up --build
  ```

4. Open the Project in Your Browser:

## Dependencies

- Docker
- Docker Compose
