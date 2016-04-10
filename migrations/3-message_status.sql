ALTER TABLE test_messages ADD COLUMN `status` INT DEFAULT 0 AFTER `is_approved`;
UPDATE test_messages SET status = 10 WHERE `is_approved` = true;
ALTER TABLE test_messages DROP COLUMN `is_approved`;