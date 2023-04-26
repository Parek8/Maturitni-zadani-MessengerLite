CREATE DATABASE IF NOT EXISTS maturita;

                    USE maturita;
                    
                    CREATE TABLE IF NOT EXISTS users(
                        id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
                        first_name VARCHAR(64) NOT NULL,
                        last_name VARCHAR(64) NOT NULL,
                        username VARCHAR(64) UNIQUE NOT NULL,
                        pass VARCHAR(64) NOT NULL,
                        email VARCHAR(255) UNIQUE NOT NULL,
                        question TEXT NOT NULL,
                        answer TEXT NOT NULL,
                        description TEXT,
                        create_date DATETIME NOT NULL
                    );
                    
                    CREATE TABLE IF NOT EXISTS message_history(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        content VARCHAR(1024) NOT NULL,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
    					sent_date DATETIME NOT NULL,
                        FOREIGN KEY (sender_id) REFERENCES users(id),
                        FOREIGN KEY (reciever_id) REFERENCES users(id)      
                    );
                    
                    CREATE TABLE IF NOT EXISTS friends(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
                        FOREIGN KEY(sender_id) REFERENCES users(id),
                        FOREIGN KEY(reciever_id) REFERENCES users(id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS friend_requests(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
                        FOREIGN KEY(sender_id) REFERENCES users(id),
                        FOREIGN KEY(reciever_id) REFERENCES users(id)
                    );
                    
                    CREATE TABLE IF NOT EXISTS notifications(
                        id INT PRIMARY KEY AUTO_INCREMENT,
                        type ENUM('Friend Request', 'New Post', 'Remove Friend', 'Message') NOT NULL,
                        content VARCHAR(512) NOT NULL,
                        sender_id INT NOT NULL,
                        reciever_id INT NOT NULL,
                        FOREIGN KEY(sender_id) REFERENCES users(id),
                        FOREIGN KEY(reciever_id) REFERENCES users(id)
                    );
