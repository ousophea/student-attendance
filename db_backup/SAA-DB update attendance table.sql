#UPDATE `tbl_attendances` SET `att_ter_id`=1 
#WHERE att_date <= '2012-03-31';
#UPDATE `tbl_attendances` SET `att_ter_id`=2 
#WHERE att_date < '2012-06-31'
#		AND att_date > '2012-03-31';
UPDATE `tbl_attendances` SET `att_ter_id`=3 
WHERE att_date <= '2012-09-30'
		AND att_date >= '2012-07-01';
UPDATE `tbl_attendances` SET `att_ter_id`=4 
WHERE att_date <= '2012-12-31'
		AND att_date >= '2012-10-01';