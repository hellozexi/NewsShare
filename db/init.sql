CREATE TABLE IF NOT EXISTS users (
    `email` VARCHAR(30),
    `nickname` VARCHAR(50),
    `password` VARCHAR(80) NOT NULL,
    PRIMARY KEY(`email`)
) engine = InnoDB default CHARACTER SET = utf8 collate = utf8_general_ci;

CREATE TABLE IF NOT EXISTS stories (
    `story_id` VARCHAR(30),
    `title` TEXT NOT NULL,
    `content` LONGTEXT NOT NULL,
    `link` VARCHAR(255),
    `story_author` VARCHAR(30),
    PRIMARY KEY(`story_id`),
    FOREIGN KEY (`story_author`) references `users` (`email`)
) engine = InnoDB default CHARACTER SET = utf8 collate = utf8_general_ci;

CREATE TABLE IF NOT EXISTS comments (
    `comment_id` VARCHAR(30),
    `story_id` VARCHAR(30),
    `comment_author` VARCHAR(30) NOT NULL,
    `content` TEXT NOT NULL,
    PRIMARY KEY(`comment_id`),
    FOREIGN KEY (`story_id`) references `stories` (`story_id`) ON DELETE CASCADE,
    FOREIGN KEY (`comment_author`) references `users` (`email`)
) engine = InnoDB default CHARACTER SET = utf8 collate = utf8_general_ci;
