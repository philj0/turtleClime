import pymysql.cursors

# Read Temp from file
file = open("/sys/bus/w1/devices/28-0316a17d01ff/w1_slave","r")

for i, line in enumerate(file):
    if i == 1:
        str = line.split("=")[1]
	temp = str[:2]
	temp += "."
	temp += str[2:3]

file.close()

# Connect to the database
connection = pymysql.connect(host='localhost',
                             user='root',
                             password='root',
                             db='turtleClime',
                             charset='utf8mb4',
                             cursorclass=pymysql.cursors.DictCursor)

try:
    with connection.cursor() as cursor:
        # Create a new record
        sql = "INSERT INTO `tc_data` (`Temp`, `Hum`, `Light_On`, `Light_Off`) VALUES (%s, %s, %s, %s)"
        cursor.execute(sql, (temp, '70', '2018-01-24 09:17:24', '2018-01-24 18:17:24'))

    # connection is not autocommit by default. So you must commit to save
    # your changes.
    connection.commit()

finally:
    connection.close()
