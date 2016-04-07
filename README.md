# WORKPLAN
WorkPlan.Gov - A web application for local municipal governments' work plan & capacity analysis 

## Features
This web application has been developed for time and project management for numicipal government staff. This tool offers a concise method for creating, implementing and tracking Municipal Projects and the requisite tasks and time commitments associated. See http://courtenay.city/workplan for demo. 


## Message from the CAO of City of Courtenay
While strategic planning is being increasingly implemented in Local Government, there is currently a disconnect between strategic planning and corporate capacity. The City of Courtenay has developed and implemented a corporate capacity program based on Open Source programming. This new program allows for the development of an annual Work Plan that is based both on Council’s strategic priorities, and the City’s statutory requirements. Each year the Work Plan is collectively developed by the senior management team, and once approved by Council, is supported by the Financial Plan.  The Work Plan resides on the City’s intranet and is directly connected to individual staff timesheets providing real time analysis and feedback to department heads and managers. In combination with monthly financial status updates, the Work Plan is the CAO’s tool for oversight of managers, reporting to Council and the public, and to establish annual performance measures for Administration and senior management.

In a time of increasing demand for “Value for Money” in Local Government, as demonstrated by the creation of an Auditor General for Local Government in 2012, estimating and tracking corporate capacity enhances the use of scarce human and financial resources, and provides greater transparency, municipal performance measurement, and reporting.

David Allen  
Chief Administrative Officer, City of Courtenay  
Co-Chair, Asset Management BC  
www.courtenay.ca  


## Requirements
The source code for the initial commit was tested in the following environment:  
   OS: Debian GNU Linux 6 (64-bit)  
   Web server: Apache/2.2.22 (Debian)  
   Database: MySQL 5.5.40-0+wheezy1  
   PHP: Ver 5.4.35-0+deb7u2 .  
   
   
## Installation
WorkPlan.Gov setup
basic instructions for a linux server.

Create a Database called "workplan" and restore the database schema to it with the included workplan.sql using MySQL Administrator, phpmyadmin etc. 
unzip the workplan archive to your webserver and chmod 777 the templates_c directory.
you will need the php-gd libraries if you want to upload user pictures and chmod 777 the images directory.

edit the app_settings.php around line 22 to reflect your mysql settings.
you can also modify the header text, Logo and footer text.

once done browse to http://yourserver/workplan/
if you run into the infamous "white screen" you can comment out debug level on line 4 in settings.php

you can log in with :

user: Manager One
psswd: manager1

user: Manager Two
psswd: manager2

user: Manager Three
psswd: manager3

Note the  "admin" account must be record 1 (in the staff table) as there are a few hard coded references to %CURRENT_USER_ID%

Workplan uses Smarty 2 which allows a template based system. to customize reports, charts etc look into:
workplan/components/templates/custom_templates


## License
WorkPlan.Gov License Agreement  
Copyright (c) 2013 - 2015, City of Courtenay.  
All rights reserved.  

This license is a legal agreement between you and City of Courtenay, for the use of WorkPlan.Gov Software (the "Software"). By obtaining the Software you agree to comply with the terms and conditions of this license.  
  
Permitted Use  
You are permitted to use, copy, modify, the Software and its documentation, with or without modification, for any purpose, provided that the following conditions are met:  
1.	A copy of this license agreement must be included with the distribution.  
2.	Source code must retain the above copyright notice in all source code files.  
3.	Any files that have been modified must carry notices stating the nature of the change and the names of those who changed them.  
4.	The Software shall not be published, propagated, distributed, sublicensed, and/or sold without expressed permission from the City of Courtenay.  
  
Indemnity  
You agree to indemnify and hold harmless the authors of the Software and any contributors for any direct, indirect, incidental, or consequential third-party claims,  
actions or suits, as well as any related expenses, liabilities, damages, settlements or fees arising from your use or misuse of the Software, or a violation of any terms of this license.  
Disclaimer of Warranty  
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, WARRANTIES OF QUALITY, PERFORMANCE, NON-INFRINGEMENT, MERCHANTABILITY, OR FITNESS FOR A PARTICULAR PURPOSE.  
  
Limitations of Liability  
YOU ASSUME ALL RISK ASSOCIATED WITH THE INSTALLATION AND USE OF THE SOFTWARE.  
IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS OF THE SOFTWARE BE LIABLE FOR CLAIMS, DAMAGES OR OTHER LIABILITY ARISING FROM, OUT OF, OR IN CONNECTION WITH THE SOFTWARE.  
LICENSE HOLDERS ARE SOLELY RESPONSIBLE FOR DETERMINING THE APPROPRIATENESS OF USE AND ASSUME ALL RISKS ASSOCIATED WITH ITS USE, 
INCLUDING BUT NOT LIMITED TO THE RISKS OF PROGRAM ERRORS, DAMAGE TO EQUIPMENT, LOSS OF DATA OR SOFTWARE PROGRAMS, OR UNAVAILABILITY OR INTERRUPTION OF OPERATIONS.  

