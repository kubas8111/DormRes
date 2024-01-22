# Dorm Res Readme

## Introduction

Welcome to the Dormitory Room Reservation System, a robust web application designed to streamline the process of reserving rooms in university dormitories. Built using Docker containers, PostgreSQL as the database management system, and featuring a well-defined Entity-Relationship Diagram (ERD), this system ensures a seamless and efficient experience for both users and administrators.

## Docker Containers

In the Dormitory Room Reservation System project, we utilize several Docker containers to provide a comprehensive runtime environment.

1. **nginx:** Container containing the Nginx HTTP server, responsible for serving static files and acting as a reverse proxy for the PHP application.

2. **php:** Container housing the PHP interpreter to handle the business logic in our web application.

3. **postgres:** Container holding the PostgreSQL database, used for storing reservation and user data.

4. **pgadmin4:** Container incorporating the pgAdmin 4 tool, allowing for the management of the PostgreSQL database through a graphical interface.


## Configuration

1. 

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
