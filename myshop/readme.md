## Screen Shots
![Capture](https://github.com/ahadrazadev/Database-Project/assets/147371347/80f473e9-993e-424d-83d0-4bc622fac973)


![22](https://github.com/ahadrazadev/Database-Project/assets/147371347/e585abf7-1636-4014-b678-ebe32c4420ab)

## Paste this in your mysql page
```sql
CREATE TABLE clients (
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(200) NOT NULL UNIQUE,
    phone VARCHAR(20) NULL,
    address VARCHAR(200) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO clients (name, email, phone, address)
VALUES
('Bill Gates', 'bill.gates@microsoft.com', '+123456789', 'New York, USA'),
('Elon Musk', 'elon.musk@spacex.com', '+111222333', 'Florida, USA'),
('Will Smith', 'will.smith@gmail.com', '+111333555', 'California, USA'),
('Bob Marley', 'bob@gmail.com', '+111555999', 'Texas, USA'),
('Cristiano Ronaldo', 'cristiano.ronaldo@gmail.com', '+32447788993', 'Manchester, England'),
('Boris Johnson', 'boris.johnson@gmail.com', '+4499778855', 'London, England');
