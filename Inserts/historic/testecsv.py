id = None
		id_individual+=1
		id_event = row['Event_id']
		Institute_id = row['Institute_id']
		local_id = row['local_id'] if row['local_id']!="NA" else None
		date = row['Date'] if row['Date']!="NA" else None
		observation = row['Observation'] if row['Observation']!="NA" else None