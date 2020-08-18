import csv

with open('institute/institute.csv', newline='\n') as csvfile:
	read= csv.DictReader(csvfile, delimiter=',')

	with open('../SQL/2.institute.sql', 'w') as file:
		for row in read:
			state = f"\'{row['state']}\'" if row['state']!="NA" else "NULL"
			city = f"\'{row['city']}\'" if row['city']!="NA" else "NULL"
			priority = row['priority'] if row['priority']!="NA" else "NULL"
			
			sql= f"INSERT INTO `institute` (`id`, `name`, `abbreviation`, `country`, `state`, `city`, `priority`) VALUES (NULL, '{row['name']}', '{row['abbreviation']}', '{row['country']}', {state}, {city}, {priority});\n"
			file.write(sql)