CREATE TABLE roomMenu (
   room_id INT AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(50) NOT NULL,
   description TEXT NOT NULL,
   base_price DECIMAL(10,2) NOT NULL,
   price_increment DECIMAL(10,2) NOT NULL,
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO roomMenu (name, description, base_price, price_increment) VALUES
        ('Business Meeting room', 'Room where you can have meetings with business partners, colleagues, etc. 5 OMR/hour, +2 for every size increase.', 5.00, 2.00),
        ('Podcast room', 'Soundproofed room to record podcasts or songs. 10 OMR/hour, +4 for every size increase.', 10.00, 4.00),
        ('Teaching room', 'Room specially made to teach a class of students. 4 OMR/hour, +2 for every size increase.', 4.00, 2.00),
        ('Cinema Style room', 'Room to enjoy educational videos on a big screen. 8 OMR/hour, +3 for every size increase.', 8.00, 3.00)";

