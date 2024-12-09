# EZ_xamp_deployer

A Docker deployment environment that allows you to create proof of concepts in PHP in every operative system.

## How to install

### Step 1

Download and install Docker for your OS from the [Docker official page](https://www.docker.com/).

### Step 2

Clone the EZ_xamp_deployer on your computer using.

```
    git clone https://github.com/dpavon-g/EZ_xamp_deployer.git
```

### Step 3

Go to the ```EZ_xamp_deployer``` folder on your computer and create a new folder named ```html```.
Place your PHP code inside this ```html``` folder. Every change you make there will be reflected in your PHP environment, allowing you to easily develop and see your updates in real-time.

### Step 4

Open the Docker program you previously installed. Once it’s open, navigate to the ```EZ_xamp_deployer``` folder on your computer and run the following command:

```
docker compose up --build
```

Your XAMPP environment should now be working correctly.

## How to connect now

If everything goes well, you should now have three Docker containers running on your computer: one with ```Apache2``` to execute the PHP code, another with the ```MySQL``` database, and a third one with ```phpMyAdmin```.

### Connect to Apache2
http://localhost:8080

### Connect to phpMyAdmin
http://localhost:8081

### Connect to the DB
Docker uses its own routes for services, so if you want to connect to the database from Apache2, you only need to type ```db``` as the address for the database.

## Things you need to know

By default, port ```8080``` is needed to connect to ```Apache2```, and port ```8081``` to connect to ```phpMyAdmin```. On your computer, these ports might be closed. If this happens, open the ```docker-compose.yml``` file and change the ports for any service that is not working.

If something doesn’t work, feel free to message me on my [LinkedIn profile](www.linkedin.com/in/pavondaniel), and I’ll be happy to help you! 😊