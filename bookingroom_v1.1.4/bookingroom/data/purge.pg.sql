-- $Id: purge.pg.sql,v 1.3 2004/04/14 22:18:34 gwalker Exp $
--
-- mrbs/purge.pg.sql 2001-01-13 : Purge old MRBS entries, for PostgreSQL
--
-- This SQL script will delete old entries from your MRBS database.
-- By default, entries which ended 30 days or more in the past will be removed,
-- Repeat table records with no corresponding entry records will be removed.
--
-- If old entries get purged from a series, then somebody edits the series,
-- the old entries will be re-created unless they change the start date on
-- the form. Fixing this would require changing the start_time and end_time
-- in the repeat record to match oldest undeleted entry; this is left as an
-- exercise to the reader.
--
-- If you have decided to change the prefix of your tables from 'mrbs_'
-- to something else then you must edit each 'DELETE FROM' line below.
--

BEGIN;

DELETE FROM mrbs_entry
WHERE end_time < date_part('epoch', current_timestamp - interval '30 days');

DELETE FROM mrbs_repeat
WHERE id NOT IN (SELECT repeat_id FROM mrbs_entry);

COMMIT;
