
# turtleClime

Simple and slim web app to display and manage sensor data/values from one or more of your smart home devices.

![turtleClime Demo](/.github/screenshots/turtleclime.gif?raw=true "turtleClime Demo")

## Getting Started

Clone the repository on your (local) web server or local machine. See **Prerequisites** and **Installing** for more information.

### Prerequisites

1. Raspberry Pi or local machine as web server
2. Temperature, humidity or other sensor and/or other smart home devices
3. MySQL Database to persist values from the sensors

### Installing

If you use your local machine as web server you can jump to 3.!

1. Install a fresh image of Raspbian or your prefer OS on the Raspberry Pi (You can also use a running Raspberry Pi)
2. Install apache2, php5, mysql and phpmyadmin
```
sudo apt-get install apache2
```
```
sudo apt-get install php5
```
```
sudo apt-get install mysql-server php5-mysql mysql-client
```
```
sudo apt-get install php5-mysql libapache2-mod-auth-mysql phpmyadmin
```
3. Clone the repository in your /var/www/ directory or the directory of your preferred web server
4. Set up the MySQL Database: Database name "turtleClime"
And create two tables: First name "tc_log" for logging of the app with the following rows: 'ID' (bigint), 'Action' (varchar), 'Status' (varchar), 'User' (varchar), Timestamp (timestamp). Second name "tc_data" to persist the data/values from your sensors with the following rows: 'ID' (bigint), 'Temp' (float), 'Light_On' (timestamp), 'Light_Off' (timestamp), Timestamp (timestamp). You can adjust all columns for your needs (except for 'ID' and 'Timestamp'). By default I choose 'Temp' (for temperature) and 'Light_On' and 'Light_Off' (timestamp when light goes on and off).
5. Edit the following 2 files with the login and name of your database, and the names of your tables: /php/inc/db.php and /python-backend/logData.py
6. Type "localhost://turtleClime/status.html" into your browser and check if all services are alive.

Note: You have to log data/values into your Database before it will displayed on the app.

Customize the front-end for your needs. And don't forget to adjust the php scripts to fit to your database columns :-)

## Contributing

Please read [CONTRIBUTING.md](/.github/CODE_OF_CONDUCT.md) for details on our code of conduct, and the process for submitting pull requests to us.

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details


## Acknowledgments

* In this Repository I used Pure CSS Percentage Circle by [Andre Firchow](http://circle.firchow.net/)
