USE MoviePass;

INSERT INTO users (name,password,admin) VALUES ("admin","admin",1);
INSERT INTO users (name,password,admin) VALUES ("matias","pas",0);
INSERT INTO users (name,password,admin) VALUES ("gonzalo","per",0);
INSERT INTO users (name,password,admin) VALUES ("maite","lop",0);
INSERT INTO users (name,password,admin) VALUES ("franco","pas",0);

INSERT INTO cinemas (name,totalCapacity,address,ticketValue,enable) VALUES ("Cineman", 500, "san martin y cordoba",250,1);
INSERT INTO cinemas (name,totalCapacity,address,ticketValue,enable) VALUES ("Don Remoto", 400, "cordoba y colon",150,1);
INSERT INTO cinemas (name,totalCapacity,address,ticketValue,enable) VALUES ("Borelal", 300, "colon y san juan",350,1);
INSERT INTO cinemas (name,totalCapacity,address,ticketValue,enable) VALUES ("Once 26", 200, "san juan y juan b justo",280,1);
INSERT INTO cinemas (name,totalCapacity,address,ticketValue,enable) VALUES ("La Pelota Naranja", 100, "juan b justo e independencia",290,1);
INSERT INTO cinemas (name,totalCapacity,address,ticketValue,enable) VALUES ("TVr", 450, "independencia y moreno",310,1);
INSERT INTO cinemas (name,totalCapacity,address,ticketValue,enable) VALUES ("Ta chi To", 350, "moreno y salta",300,1);