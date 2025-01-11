-- General Categories (e.g., Cleaning, Maintenance, etc.)
CREATE TABLE general_categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Categories (e.g., Kitchen, Bathroom, Plumbing, etc.)
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    general_category_id INT NOT NULL,
    FOREIGN KEY (general_category_id) REFERENCES general_categories(id)
);

-- Modes (e.g., Weekly, Monthly, etc.)
CREATE TABLE modes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);

-- Tasks (e.g., Sweep the floor, Clean the bathtub, etc.)
CREATE TABLE tasks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    task_name VARCHAR(255) NOT NULL,
    category_id INT, -- Nullable for tasks without a category
    mode_id INT, -- Nullable for tasks without a specific mode
    is_active BOOLEAN NOT NULL DEFAULT TRUE, -- Default to active
    FOREIGN KEY (category_id) REFERENCES categories(id),
    FOREIGN KEY (mode_id) REFERENCES modes(id)
);

-- Insert Modes
INSERT INTO modes (name) VALUES ('Weekly'), ('Monthly');

-- Insert General Categories
INSERT INTO general_categories (name) VALUES
('Cleaning'),
('Maintenance'),
('Appliances'),
('Shopping'),
('Financial'),
('Family'),
('Organization'),
('Cooking'),
('Gardening'),
('Social'),
('Self-Care'),
('No Category');

-- Insert Categories for Cleaning
INSERT INTO categories (name, general_category_id) VALUES
('Kitchen', 1),
('Bedroom', 1),
('Office', 1),
('Bathroom', 1),
('Toilet', 1),
('Living Room', 1);

-- Insert Tasks for Cleaning
-- Kitchen
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Sweep the floor', 1, 1, TRUE),
('Clean the floor', 1, 1, TRUE),
('Take out the trash', 1, 1, TRUE),
('Take out compost', 1, 1, TRUE);

-- Bedroom
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Sweep the floor', 2, 1, TRUE),
('Clean the floor', 2, 1, TRUE),
('Dust the room', 2, 1, TRUE),
('Change sheets', 2, 1, TRUE);

-- Office
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Sweep the floor', 3, 1, TRUE),
('Clean the floor', 3, 1, TRUE),
('Dust the floor', 3, 1, TRUE);

-- Bathroom
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Clean the bathroom', 4, 1, TRUE),
('Clean the bathtub', 4, 1, TRUE);

-- Toilet
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Clean the toilets', 5, 1, TRUE);

-- Living Room
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Sweep the floor', 6, 1, TRUE),
('Clean the floor', 6, 1, TRUE),
('Dust the floor', 6, 1, TRUE);

-- Tasks Without a Category
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Water the plants', NULL, 1, TRUE),
('Do groceries', NULL, 1, TRUE),
('Launch a washing machine', NULL, 1, TRUE),
('Fold the washed clothes', NULL, 1, TRUE);

-- Insert Categories for Maintenance
INSERT INTO categories (name, general_category_id) VALUES
('Plumbing', 2),
('Electrical', 2),
('HVAC', 2),
('Outdoor', 2),
('Appliances', 3);

-- Insert Tasks for Maintenance
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Fix leaking faucet', 7, NULL, TRUE),
('Unclog the drain', 7, NULL, TRUE),
('Replace light bulbs', 8, NULL, TRUE),
('Fix broken switch', 8, NULL, TRUE),
('Clean air filters', 9, NULL, TRUE),
('Schedule HVAC maintenance', 9, NULL, TRUE),
('Repair fence', 10, NULL, TRUE),
('Clean gutters', 10, NULL, TRUE),
('Defrost the freezer', 11, NULL, TRUE),
('Clean the oven', 11, NULL, TRUE);

-- Insert Categories for Shopping
INSERT INTO categories (name, general_category_id) VALUES
('Groceries', 4),
('Household Supplies', 4),
('Personal Care', 4),
('Seasonal Items', 4);

-- Insert Tasks for Shopping
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Buy milk, bread, and eggs', 12, NULL, TRUE),
('Restock pantry essentials', 12, NULL, TRUE),
('Purchase cleaning products', 13, NULL, TRUE),
('Buy trash bags', 13, NULL, TRUE),
('Buy shampoo and soap', 14, NULL, TRUE),
('Restock toothpaste', 14, NULL, TRUE),
('Buy winter coats', 15, NULL, TRUE),
('Purchase holiday decorations', 15, NULL, TRUE);

-- Insert Categories for Financial
INSERT INTO categories (name, general_category_id) VALUES
('Bills', 5),
('Budgeting', 5),
('Taxes', 5),
('Subscriptions', 5);

-- Insert Tasks for Financial
INSERT INTO tasks (task_name, category_id, mode_id, is_active) VALUES
('Pay electricity bill', 16, NULL, TRUE),
('Pay credit card bill', 16, NULL, TRUE),
('Review monthly expenses', 17, NULL, TRUE),
('Plan next month\'s budget', 17, NULL, TRUE),
('Prepare tax documents', 18, NULL, TRUE),
('File tax returns', 18, NULL, TRUE),
('Renew streaming service subscription', 19, NULL, TRUE),
('Cancel unused subscriptions', 19, NULL, TRUE);