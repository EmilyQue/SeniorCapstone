# ADVENTR: A Community Travel Guide


## Introduction
The purpose of this project is to encourage and allow new or expert travelers to share their experiences, whether good or bad, with others as well as sharing any recommendations related to food, sights to see, places to stay, etc.. For many people, planning a vacation is often a difficult and stressful task but this site would facilitate the process of creating an itinerary. Through personal experience and observation, a variety of random sites on Google are used by travelers to answer any questions during planning. Having all that information presented in one single place would provide a more convenient solution to the problem. 

## Requirements
##### Technical and Non-Technical Requirements
The project requirements can be found [here](https://github.com/EmilyQue/SeniorCapstone/blob/main/documents/Milestone%206%20Test%20Cases.xls)

##### Cloud Hosting
The project is hosted on Heroku, which can be viewed [here](http://adventr-blog.herokuapp.com/home)

##### DevOps Integration
* Logging: A single logger was created so standard log statements complete with the date, time, level of severity, message, and context were outputted. The log statements were called for the entry and exit of all the methods in the controllers, business services, and data services, as well as any exceptions found within the application.
* Monitoring: Monitoring was integrated through the use of UptimeRobot, which is a monitoring service that keeps track of the status codes of the application every 5 minutes and alerts the developer if the website is down.
* CI/CD: A build pipeline was integrated through the use of Heroku and Github. 

## Technologies
The technologies used in this project include:
* Visual Studio Code (Version: 1.53.2 for Mac & Windows) 
* Laravel (Version: 8.22.1) 
* PHP (Version: 7.4.5) 
* MySQL
* Xampp
* Bootstrap
* Github

## Technical Approach
The general technical approach taken was to design the diagrams and wireframes first, to understand what the application would look like. Then I set up the database in MySQL to have the proper tables. I used a previous project of a blog that I made a few semesters ago as a reference. During that time, I used the Laravel framework to create the blog, which is why I decided to use the same framework to make this project, as it is the one that I am most familiar with. Additionally, I plan to use Bootstrap for the user interface.

The sitemap diagram below shows the connections between each web page. The registration page directs the user to the login page, and the login page directs the user to the home page. The home page will have access to the posts and user account. 
<img src="https://github.com/EmilyQue/SeniorCapstone/blob/main/documents/diagrams/capstone%20sitemap.png" width="400" height="470">

The entity relationship diagram shows how each entity stored in a database is related to each other. For this project, there are four entities: users, posts, profile, and recent travels. <br/>
<img src="https://github.com/EmilyQue/SeniorCapstone/blob/main/documents/diagrams/capstone%20er%20diagram.png" width="500" height="350">

The class diagram models the structure of a system by showing the relationships between each classes, objects, and operations. For this project, I will be using the n-layer architecture and Model-View-Controller pattern. The model holds the data, the view consists of the user interface, and the controller processes user input. N-layer architecture consists of the presentation layer, business logic layer, and data access layer.
![class diagram](https://github.com/EmilyQue/SeniorCapstone/blob/main/documents/diagrams/capstone%20classdiagram.png)

## Outstanding Issues
There are currently no outstanding issues.
