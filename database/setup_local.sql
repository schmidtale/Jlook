CREATE DATABASE IF NOT EXISTS jlook;
USE jlook;

DROP TABLE IF EXISTS favorites;
DROP TABLE IF EXISTS reservations;
DROP TABLE IF EXISTS users;
DROP TABLE IF EXISTS tours;

CREATE TABLE IF NOT EXISTS tours (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    city VARCHAR(100) NOT NULL,
    price_yen INT NOT NULL,
    available_seats INT NOT NULL DEFAULT 0,
    description TEXT,
    image VARCHAR(255) NOT NULL,
    CONSTRAINT chk_available_seats CHECK (available_seats >= 0)
);

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tour_id INT NOT NULL,
    user_id INT NOT NULL,
    reservation_date DATE NOT NULL,
    number_of_guests INT NOT NULL,
    total_price_yen INT NOT NULL,
    status ENUM('confirmed', 'completed', 'cancelled') NOT NULL DEFAULT 'confirmed',

    CONSTRAINT fk_reservations_tours FOREIGN KEY (tour_id) REFERENCES tours(id),
    CONSTRAINT fk_reservations_users FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE IF NOT EXISTS favorites (
    user_id INT NOT NULL,
    tour_id INT NOT NULL,
    PRIMARY KEY (user_id, tour_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (tour_id) REFERENCES tours(id) ON DELETE CASCADE
);

INSERT IGNORE INTO `tours` (`id`, `name`, `city`, `price_yen`, `available_seats`, `description`, `image`) VALUES
(1, 'Tokyo City Tour', 'Tokyo', 23000, 24, 'Experience the very best of Tokyo in one unforgettable day. From the serene Imperial Palace gardens to the electric buzz of Shibuya Crossing, this expertly guided tour covers the city\'s most iconic landmarks with insider commentary you won\'t find in any guidebook. Skip the lines, discover hidden gems, and fall in love with the world\'s greatest city.', 'Tokyo_city.png'),
(2, 'Asakusa & Skytree', 'Tokyo', 23000, 25, 'Step back in time in Asakusa\'s historic shitamachi streets, then soar to the clouds atop Tokyo Skytree — the world\'s tallest tower. This perfectly balanced tour blends ancient temple culture with breathtaking modern views. Watch sensoji\'s incense swirl, browse Nakamise\'s traditional crafts, then gaze out over the endless Tokyo skyline from 450 meters above.', 'Asakusa & Skytree.jpg'),
(3, 'Ghibli Museum Visit', 'Tokyo', 27000, 81, 'Enter the enchanting world of Studio Ghibli at this magical museum in Mitaka — a dream come true for fans of Totoro, Spirited Away, and Howl\'s Moving Castle. Wander through whimsical exhibits, see original animation cels, and ride the iconic rooftop Catbus. Tickets are famously hard to get — this guided tour handles everything so you simply show up and wonder.', 'Ghibli Museum Visit.jpeg'),
(4, 'Odaiba Cruise', 'Tokyo', 12000, 36, 'Glide across Tokyo Bay on a scenic cruise to Odaiba, the city\'s futuristic artificial island. Marvel at the life-size Gundam statue, browse teamLab\'s digital art installations, and enjoy stunning views of Rainbow Bridge and the city skyline from the water. A relaxing, visually spectacular experience that shows Tokyo from a completely different angle.', 'Odaiba Cruise.jpg'),
(5, 'Shibuya & Harajuku Walk', 'Tokyo', 5000, 74, 'Dive into Tokyo\'s most vibrant youth culture on this energetic walking tour through Shibuya and Harajuku. Witness the legendary Shibuya Scramble Crossing, explore Takeshita Street\'s wild fashion scene, and stroll the tranquil Meiji Shrine forest — all within a few blocks. The best introduction to modern Tokyo\'s creative, colorful, and electric street life.', 'Shibuya & Harajuku Walk.jpeg'),
(6, 'Arashiyama Bamboo Forest', 'Kyoto', 40000, 96, 'Walk through one of the world\'s most photographed natural wonders — the towering bamboo groves of Arashiyama. Your guide leads you beyond the tourist path to hidden temples, a zen rock garden, and a scenic boat ride down the Oi River. As the bamboo sways and rustles around you, Kyoto\'s timeless magic becomes impossible to resist.', 'Arashiyama Bamboo Forest.jpeg'),
(7, 'Fushimi Inari Shrine Tour', 'Kyoto', 96000, 64, 'Thousands of vibrant vermillion torii gates wind up the sacred slopes of Mt. Inari in one of Japan\'s most iconic and spiritual landscapes. This in-depth tour ventures far beyond the crowded entrance to the quiet mountain trails where foxes roam and ancient shrines stand untouched. A deeply atmospheric experience that stays with you long after you leave Kyoto.', 'Fushimi Inari Shrine Tour.jpg'),
(8, 'Kyoto Tea Ceremony', 'Kyoto', 14500, 87, 'Slow down and experience the meditative art of Japanese tea ceremony in a traditional tatami tearoom in Kyoto. A certified tea master guides you through the graceful rituals of matcha preparation, the significance of each gesture, and the philosophy of wabi-sabi. Paired with seasonal Japanese sweets, this is a moment of pure cultural beauty and calm.', 'Kyoto Tea Ceremony.png'),
(9, 'Gion Geisha Experience', 'Kyoto', 26000, 71, 'Kyoto\'s most iconic district comes alive after dark — and this expert-guided evening tour reveals its secrets. Stroll the lantern-lit stone paths of Gion, learn the fascinating world of geiko and maiko culture, and dine on exquisite kaiseki cuisine in a traditional ochaya setting. An evening of elegance, mystery, and authentic Kyoto atmosphere.', 'Gion Geisha Experience.jpg'),
(10, 'Kinkaku-ji Temple Tour', 'Kyoto', 9500, 40, 'The Golden Pavilion is one of Japan\'s most breathtaking sights — and this guided tour ensures you experience it at its most magical. Your local guide shares the temple\'s dramatic history, the Zen Buddhist philosophy behind its design, and the best angles for that perfect reflection photograph. Includes visits to nearby hidden gardens most visitors never find.', 'Kinkaku-ji Temple Tour.jpeg'),
(11, 'Osaka Castle & Park', 'Osaka', 6000, 73, 'Dominating the Osaka skyline for over 400 years, Osaka Castle is a living monument to Japan\'s most dramatic era of history. Climb to the top floor for sweeping city views, explore the museum\'s fascinating samurai artifacts, then wander the magnificent surrounding park at your leisure. A powerful blend of history, nature, and stunning architecture.', 'Osaka Castle & Park.jpg'),
(12, 'Universal Studios Japan', 'Osaka', 15000, 52, 'Get ready for the most thrilling day in Osaka at Universal Studios Japan — home to the Wizarding World of Harry Potter, Super Nintendo World, and jaw-dropping rides for all ages. This guided tour includes skip-the-line access and expert tips to maximize every minute in the park. Pure, electrifying, world-class entertainment from the first step through the gates.', 'Universal Studios Japan.jpg'),
(13, 'Dotonbori Food Tour', 'Osaka', 19000, 50, 'Osaka lives to eat — and nowhere proves it better than the legendary Dotonbori district. This guided food tour takes you to the best takoyaki stalls, okonomiyaki joints, kushikatsu counters, and ramen shops that locals actually love. Small group, big flavors, and a guide whose food knowledge is matched only by their infectious enthusiasm for Osaka\'s greatest obsession.', 'Dotonbori Food Tour.jpeg'),
(14, 'Osaka Aquarium Kaiyukan', 'Osaka', 2400, 57, 'Come face to face with whale sharks, manta rays, and thousands of ocean creatures at Kaiyukan — one of the world\'s largest and most spectacular aquariums. Journey through eight floors of immersive ocean environments representing the Pacific Rim. A wonderfully educational and awe-inspiring experience perfect for families, couples, and anyone who loves the sea.', 'Osaka Aquarium Kaiyukan.jpeg'),
(15, 'Umeda Sky Building View', 'Osaka', 1500, 49, 'Rising above the Umeda skyline, the iconic Sky Building offers one of Japan\'s most dramatic observation experiences. Take the glass escalator to the Floating Garden Observatory and enjoy a 360-degree panoramic view of Osaka stretching to the mountains beyond. Especially magical at sunset and after dark — an unmissable view at an unbeatable price.', 'Umeda Sky Building View.jpg'),
(16, 'Sapporo Snow Festival Tour', 'Hokkaido', 60000, 47, 'Every winter, Hokkaido\'s capital transforms into a jaw-dropping wonderland of monumental snow and ice sculptures at the world-famous Sapporo Snow Festival. This guided tour navigates the festival\'s three sites, shares the stories behind the most spectacular sculptures, and includes a warming bowl of Sapporo\'s legendary miso ramen. A once-in-a-winter experience like nothing else on earth.', 'Sapporo Snow Festival Tour.jpg'),
(17, 'Otaru Canal & Glass Workshops', 'Hokkaido', 80000, 91, 'The romantic port town of Otaru enchants visitors with its gas-lit canal, Meiji-era stone warehouses, and world-renowned artisan glass workshops. This full-day tour includes a hands-on glass-blowing workshop where you create your own souvenir, followed by a tasting at Otaru\'s famous sake brewery. A beautifully crafted day in one of Hokkaido\'s most beloved towns.', 'Otaru Canal & Glass Workshops.jpg'),
(18, 'Niseko Ski Experience', 'Hokkaido', 120000, 27, 'Niseko is Japan\'s premier ski destination — and the world\'s powder snow capital. This all-inclusive ski experience puts you on Niseko\'s legendary slopes with premium equipment rental, a certified ski instructor, and access to runs for all skill levels. After a thrilling day on the mountain, warm up in a steaming outdoor onsen surrounded by snow. Pure Hokkaido perfection.', 'Niseko Ski Experience.jpeg'),
(19, 'Furano Flower Fields', 'Hokkaido', 9100, 35, 'Every summer, Hokkaido\'s Furano valley erupts into a breathtaking patchwork of lavender, sunflowers, and wildflowers stretching as far as the eye can see. This guided tour takes you through the most spectacular blooming fields, a local lavender farm, and a cheese and wine tasting at a Hokkaido dairy. Peaceful, beautiful, and completely unlike anywhere else in Japan.', 'Furano Flower Fields.jpg'),
(20, 'Shiretoko Nature Cruise', 'Hokkaido', 20000, 19, 'Venture into Shiretoko — one of Japan\'s most remote and pristine UNESCO World Heritage wilderness areas — on this spectacular nature cruise. Drift past dramatic sea cliffs, ancient forests plunging into the ocean, and keep your eyes peeled for brown bears, Steller\'s sea eagles, and whales. An extraordinary encounter with Japan\'s most untouched and magnificent natural landscape.', 'Shiretoko Nature Cruise.jpeg'),
(21, 'Churaumi Aquarium Visit', 'Okinawa', 7300, 62, 'Home to the world\'s second-largest acrylic tank, Okinawa Churaumi Aquarium is an underwater spectacle unlike any other. Watch whale sharks and manta rays glide effortlessly overhead in the legendary Kuroshio Sea tank, explore the colorful coral reef exhibits, and catch a dolphin show on the open-air stage. A world-class ocean experience the whole family will treasure.', 'Churaumi Aquarium Visit.jpeg'),
(22, 'Naha City Sightseeing', 'Okinawa', 7800, 28, 'Discover the fascinating cultural blend of Okinawa\'s vibrant capital city on this comprehensive sightseeing tour. Visit the majestic reconstructed Shuri Castle — the ancient seat of the Ryukyu Kingdom — browse the colorful arcades of Kokusai Street, and sample the island\'s unique cuisine including champuru and sata andagi donuts. Naha is unlike anywhere else in Japan.', 'Naha City Sightseeing.jpg'),
(23, 'Okinawa Beach Relaxation', 'Okinawa', 7500, 73, 'Okinawa\'s beaches are among the most beautiful in all of Asia — and this tour takes you to the finest white-sand shores with crystal-clear water that rivals the Caribbean. Spend a perfect day swimming, sunbathing, and exploring the pristine coastline with a guide who knows every secret cove and snorkeling spot. The ultimate tropical escape within Japan.', 'Okinawa Beach Relaxation.jpeg'),
(24, 'Snorkeling & Diving Tour', 'Okinawa', 5000, 32, 'Plunge beneath the surface of Okinawa\'s legendary coral seas and discover a world of jaw-dropping marine beauty. This expertly guided snorkeling and introductory diving tour takes you to vibrant coral gardens teeming with tropical fish, sea turtles, and dazzling underwater color. Full equipment provided, beginners warmly welcome — no experience needed to fall in love with the ocean.', 'Snorkeling & Diving Tour.jpg'),
(25, 'Okinawa World Culture Park', 'Okinawa', 5000, 50, 'Explore 5,000 years of Ryukyu culture at Okinawa World — a fascinating open-air park featuring a traditional village, live Eisa dance performances, venomous snake shows, and the spectacular Gyokusendo Cave, one of Japan\'s lowest limestone caverns. Hands-on, educational, and genuinely entertaining, this is the most immersive way to understand Okinawa\'s unique and captivating heritage.', 'Okinawa World Culture Park.jpg');

INSERT IGNORE INTO users (name, email, password) VALUES
('Akari Takahashi', 'akari.t@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Aoi Ito', 'aoi.ito@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Haruto Watanabe', 'haruto.w@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Hina Takahashi', 'hina.takahashi@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Hinata Tanaka', 'hinata.tanaka@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Hiroshi Kobayashi', 'hiroshi.k@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Kaito Yamada', 'kaito.yamada@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Kenji Tanaka', 'kenji.tanaka@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Mai Sato', 'mai.sato@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Mio Shimizu', 'mio.shimizu@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Ren Yamamoto', 'ren.yamamoto@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Riku Hayashi', 'riku.hayashi@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Ryota Kato', 'ryota.kato@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Sakura Yoshida', 'sakura.y@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Sota Ito', 'sota.ito@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Takumi Inoue', 'takumi.i@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Yui Suzuki', 'yui.suzuki@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Yuki Mori', 'yuki.mori@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Yuma Kimura', 'yuma.kimura@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5'),
('Yuna Nakamura', 'yuna.nakamura@example.com', '$2b$12$e0MYNfXqGgW1zM2K7B3uO.8hYf9hF6e7rC8tV9uW0xY1zZ2a3b4c5');

INSERT IGNORE INTO reservations (id, tour_id, user_id, reservation_date, number_of_guests, total_price_yen, status) VALUES
(1, 1, 8, '2025-07-01', 2, 46000, 'completed'),
(2, 5, 11, '2025-07-03', 4, 20000, 'completed'),
(3, 7, 6, '2025-07-05', 1, 96000, 'completed'),
(4, 12, 15, '2025-07-07', 3, 45000, 'completed'),
(5, 16, 3, '2025-07-09', 2, 120000, 'completed'),
(6, 22, 13, '2025-07-11', 5, 39000, 'completed'),
(7, 2, 7, '2025-07-02', 1, 23000, 'completed'),
(8, 6, 18, '2025-07-04', 6, 40000, 'completed'),
(9, 9, 10, '2025-07-06', 2, 52000, 'completed'),
(10, 14, 19, '2025-07-08', 1, 2400, 'completed'),
(11, 18, 4, '2025-07-10', 3, 360000, 'completed'),
(12, 24, 8, '2025-07-12', 4, 20000, 'completed'),
(13, 3, 9, '2025-07-03', 5, 135000, 'completed'),
(14, 8, 17, '2025-07-05', 2, 29000, 'completed'),
(15, 11, 1, '2025-07-07', 3, 18000, 'completed'),
(16, 15, 20, '2025-07-09', 1, 1500, 'completed'),
(17, 20, 2, '2025-07-11', 4, 80000, 'completed'),
(18, 25, 14, '2025-07-13', 2, 10000, 'completed'),
(19, 4, 5, '2025-07-04', 2, 24000, 'completed'),
(20, 10, 12, '2025-07-06', 1, 9500, 'completed'),
(21, 13, 16, '2025-07-08', 3, 57000, 'completed'),
(22, 17, 9, '2025-07-10', 5, 400000, 'completed'),
(23, 21, 17, '2025-07-12', 2, 14600, 'completed'),
(24, 23, 1, '2025-07-14', 6, 45000, 'completed'),
(25, 1, 20, '2025-07-02', 3, 69000, 'completed'),
(26, 5, 2, '2025-07-04', 2, 10000, 'completed'),
(27, 7, 14, '2025-07-06', 4, 384000, 'completed'),
(28, 12, 5, '2025-07-08', 1, 15000, 'completed'),
(29, 16, 12, '2025-07-10', 5, 300000, 'completed'),
(30, 22, 16, '2025-07-12', 2, 15600, 'completed'),
(31, 2, 4, '2025-07-03', 4, 92000, 'completed'),
(32, 6, 8, '2025-07-05', 3, 40000, 'completed'),
(33, 9, 11, '2025-07-07', 1, 26000, 'completed'),
(34, 14, 6, '2025-07-09', 2, 4800, 'completed'),
(35, 18, 15, '2025-07-11', 6, 720000, 'completed'),
(36, 24, 3, '2025-07-13', 3, 15000, 'completed'),
(37, 3, 13, '2025-07-04', 2, 54000, 'completed'),
(38, 8, 7, '2025-07-06', 4, 58000, 'completed'),
(39, 11, 18, '2025-07-08', 5, 30000, 'completed'),
(40, 15, 10, '2025-07-10', 3, 4500, 'completed'),
(41, 20, 19, '2025-07-12', 1, 20000, 'completed'),
(42, 25, 9, '2025-07-14', 5, 25000, 'completed'),
(43, 4, 17, '2025-07-05', 3, 36000, 'completed'),
(44, 10, 1, '2025-07-07', 2, 19000, 'completed'),
(45, 13, 20, '2025-07-09', 4, 76000, 'completed'),
(46, 17, 2, '2025-07-11', 1, 80000, 'completed'),
(47, 21, 14, '2025-07-13', 3, 21900, 'completed'),
(48, 23, 5, '2025-07-15', 2, 15000, 'completed'),
(49, 1, 12, '2025-07-03', 4, 92000, 'completed'),
(50, 5, 16, '2025-07-05', 1, 5000, 'completed');

INSERT IGNORE INTO users (name, email, password) VALUES ('Test Admin', 'admin@jlook.com', '$2y$12$8xB1kVIoRoB715s.rEiQUOeYRKLtEznN9bYqieLU/B/PiFq4Q/aAS');

-- Insert favorites for 'Test Admin' (user_id = 21)
-- Tour IDs: 1 (Tokyo City Tour), 2 (Asakusa & Skytree), 3 (Ghibli Museum Visit)
INSERT IGNORE INTO favorites (user_id, tour_id) VALUES
(21, 1),
(21, 2),
(21, 3);

INSERT IGNORE INTO reservations (tour_id, user_id, reservation_date, number_of_guests, total_price_yen, status) VALUES
(12, 21, '2027-10-15', 3, 45000, 'confirmed'),  -- 3 guests * 15,000 yen
(18, 21, '2028-01-20', 2, 240000, 'confirmed'), -- 2 guests * 120,000 yen
(6,  21, '2028-05-12', 1, 40000, 'confirmed');   -- 1 guest * 40,000 yen