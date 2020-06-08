import csv

# FRAGMENT
with open('wild_location/fragment.csv', newline='\n') as csvfile:
	read_fragment = csv.DictReader(csvfile, delimiter=',')

	with open("../SQL/6.wild_location.sql", 'w') as file:
		file.write("delete from ind_fragment; alter table ind_fragment AUTO_INCREMENT = 1; \
			delete from fragment; alter table fragment AUTO_INCREMENT = 1;\
			\n\n-- ************************************** `Fragment`\n")
		for row in read_fragment:
			sql= f"INSERT INTO `fragment` (`id`, `fragment`, `abrreviation`, `country`, `state`, `city`) VALUES (NULL, '{row['fragment']}', NULL, NULL, NULL, NULL);\n"
			file.write(sql)