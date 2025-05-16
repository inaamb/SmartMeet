CREATE TABLE room_booking_form (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_name VARCHAR(100) NOT NULL,
    customer_email VARCHAR(100) NOT NULL,
    customer_phone VARCHAR(20) NOT NULL,
    room_type VARCHAR(50) NOT NULL,
    booking_date DATE NOT NULL,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    num_attendees INT NOT NULL,
    needs_catering BOOLEAN DEFAULT FALSE,
    equipment_needed VARCHAR(255), 
    additional_notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO room_booking_form (
    customer_name, customer_email, customer_phone, room_type,
    booking_date, start_time, end_time, num_attendees,
    needs_catering, equipment_needed, additional_notes
) VALUES
-- Booking 1: Business meeting with projector
('Ahmed Al-Maskari', 'ahmed@omantel.com', '+96891234567', 'Business Meeting Room',
 '2023-12-15', '09:00:00', '12:00:00', 8,
 TRUE, 'Projector,Whiteboard', 'Need HDMI cables for projector'),

-- Booking 2: Podcast recording
('Maya Al-Rashidi', 'maya@podcast.om', '+96892345678', 'Podcast Room',
 '2023-12-16', '14:00:00', '17:00:00', 4,
 FALSE, 'Microphone,Speakers,Camera', 'Interview with government official'),

-- Booking 3: University lecture
('Dr. Khalid Al-Harthy', 'khalid@squ.edu.om', '+96893456789', 'Teaching Room',
 '2023-12-17', '08:00:00', '10:00:00', 25,
 TRUE, 'Projector,Whiteboard', 'Monthly faculty meeting'),

-- Booking 4: Movie screening
('Layla Al-Balushi', 'layla@events.om', '+96894567890', 'Cinema Style Room',
 '2023-12-18', '18:00:00', '21:00:00', 30,
 TRUE, 'Projector,Speakers', 'Children''s educational film festival'),

-- Booking 5: Workshop session
('Yousuf Al-Kindi', 'yousuf@training.om', '+96895678901', 'Creative Workshop',
 '2023-12-19', '13:00:00', '16:00:00', 12,
 FALSE, 'Whiteboard,Flipchart', 'Design thinking workshop for entrepreneurs');