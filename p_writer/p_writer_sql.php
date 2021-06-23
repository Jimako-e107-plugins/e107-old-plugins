CREATE TABLE pw_stories (
  story_id mediumint(9) NOT NULL AUTO_INCREMENT,
  story_name varchar(128) NOT NULL,
  year_written year(4) NOT NULL,
  genre_id tinyint(4) NOT NULL,
  storygroup varchar(32) NOT NULL COMMENT 'Optional group to sort story into',
  sort_order smallint(6) NOT NULL COMMENT 'Sort order inside storygroup',
  imagelink varchar(64) NOT NULL COMMENT 'Optional link to image',
  hide tinyint(1) NOT NULL,
  PRIMARY KEY (story_id)
) TYPE=MyISAM;

CREATE TABLE pw_genre (
  genre_id tinyint(4) NOT NULL AUTO_INCREMENT,
  genre_name varchar(32) NOT NULL,
  PRIMARY KEY (genre_id)
) TYPE=MyISAM;

CREATE TABLE pw_chapter (
  chapter_id smallint(6) NOT NULL AUTO_INCREMENT,
  story_id mediumint(9) NOT NULL,
  chapter_number tinyint(4) NOT NULL,
  chapter_name varchar(128) NOT NULL,
  chapter_text mediumtext NOT NULL,
  PRIMARY KEY (chapter_id)
) TYPE=MyISAM;

