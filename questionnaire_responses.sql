CREATE TABLE questionnaire_responses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    heard_from VARCHAR(50) NOT NULL,
    heard_other VARCHAR(100),
    booking_satisfaction INT NOT NULL,
    navigation_ease INT NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    cleanliness_rating INT NOT NULL,
    room_match VARCHAR(3) NOT NULL,
    room_match_reasons TEXT,
    amenities_provided VARCHAR(3) NOT NULL,
    amenities_reasons TEXT,
    submission_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);