## Fruits On The Web
Educational game for children to learn fruits and vegetables

## License

[MIT](https://choosealicense.com/licenses/mit/)

## Sources


## SQL Tables

Users table 

```bash
  CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(32),
    last_name VARCHAR(32),
    username VARCHAR(32),
    email VARCHAR(32),
    password VARCHAR(255),
    score INT
);
```

Games table 

```bash
  CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    timer INT,
    level VARCHAR(20),
    rounds INT,
    users INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

Rounds table 

```bash
  CREATE TABLE rounds (
    id INT AUTO_INCREMENT PRIMARY KEY,
    game_id INT,
    round_number INT,
    answer VARCHAR(32),
    image_path VARCHAR(255),
    FOREIGN KEY (game_id) REFERENCES games(id)
);
```

Answers table 

```bash
  CREATE TABLE answers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    round_id INT,
    answer VARCHAR(255),
    FOREIGN KEY (round_id) REFERENCES rounds(id)
);
```



## Tech Stack

**Client:** HTML, CSS, Javascript Vanilla

**Server:** PHP, MySQL

