-- $Id: destroy.pg.sql,v 1.3 2004/04/14 22:18:34 gwalker Exp $
--
-- MRBS table destruction script for PostgreSQL 7.0 or higher
-- This exists because I can never remember the sequence name magic.
--
-- If you have decided to change the prefix of your tables from 'mrbs_'
-- to something else then you must change each reference to 'mrbs_' in the
-- lines below.
--


DROP TABLE mrbs_area;
DROP SEQUENCE mrbs_area_id_seq;
DROP TABLE mrbs_room;
DROP SEQUENCE mrbs_room_id_seq;
DROP TABLE mrbs_entry;
DROP SEQUENCE mrbs_entry_id_seq;
DROP TABLE mrbs_repeat;
DROP SEQUENCE mrbs_repeat_id_seq;
