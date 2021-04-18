# BEWA

The BEWA program is a website built for small to moderate sized businesses to utilize in order to more efficiently and effectively handle organizing their employees and hours. It contains a collection of useful applications for any hours-based company, with a calendar, requests made, announcements, promoting/demoting employees, and a (currently unfinished) messaging feature.

# INSTALLATION
To install, run, and use the BEWA program, first download the BEWA file directory and the XAMPP launcher. Install and set up XAMPP as specified, default is fine. Then, extract the files for the BEWA program and copy them into the htdocs folder of the XAMPP program, with default setup and installation this will be under C:/xampp/htdocs. Afterwards, launch XAMPP and launch Apache and MySQL, and click Admin on apache. This will let you access the BEWA website.

# USE
Adding Users:
To add users, navigate to the Signup page, and enter the requested and necessary information. After doing so, the new user will be added to the employee database. If the new employee is a manager, they will have to be promoted by an admin.

Promoting Users:
To promote or demote a user, an admin will navigate to the "edit user" page and do so manually.

Announcements:
To create an announcement, navigate to the "announcement" page and fill out the required fields, the finished announcement will show on the main screen. To delete an announcement, navigate to "deleteAnnouncement" and choose the announcement you wish to delete.

Employees:
Logged in as a manager, you can add, delete, look at lists of, and approve or deny employee requests by navigating to "addEmployee", "deleteEmployee", "employeeList", and "updateEmployee"

Resetting Password:
Simply navigate to the "resetPassword" page and fill in the necessary information

Requests:
Logged in as any user, navigating to "shiftSwap" or "timeOff" will let you request to swap shifts with another employee, or request time off. Users can also view their requests in "myRequests". Managers and admins can accept or deny requests in "viewRequest"

Calendar:
Using the Google Calendar API, employees can view and track their shifts, hours worked, and current pay based on salary. These are governed by the "delete", "getevent", "insert", "load", and "update" functions baked into the API.

Chat:
The chat feature is currently non-functional, but would allow users to communicate between each other for easy communication for people trying to swap shifts or find someone to cover for them.

# Repositories and Code Bases Used
PHP 8.0.2

SQL 2019

HTML 5

ECMAScript 2016

Google Calendar API

TextMagic API
