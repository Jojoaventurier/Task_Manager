-- General Categories (e.g., Household, Cleaning)
CREATE TABLE general_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Categories (e.g., Daily, Weekly)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    general_category_id INT NOT NULL,
    FOREIGN KEY (general_category_id) REFERENCES general_categories(id)
);

-- Tasks (e.g., Vacuum, Take out trash)
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

-- Insert General Categories
INSERT INTO general_categories (name) VALUES ('Household'), ('Cleaning');

-- Insert Categories
INSERT INTO categories (name, general_category_id) VALUES ('Daily', 1), ('Weekly', 1), ('Deep Cleaning', 2);

-- Insert Tasks
INSERT INTO tasks (task_name, category_id) VALUES
('Vacuum', 1),
('Wash dishes', 1),
('Take out trash', 1),
('Mop floor', 2),
('Clean windows', 3);