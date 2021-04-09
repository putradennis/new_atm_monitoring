USE [atm_monitoring]
GO

/****** Object:  StoredProcedure [dbo].[get_user]    Script Date: 09/04/2021 16:22:22 ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


CREATE procedure [dbo].[get_user]
	
as
select  tbl_users.user_name
		,tbl_users.password
		,tbl_users.status_active
		,tbl_users.full_name
		,tbl_users.email
		--,convert(smalldatetime, tbl_users.last_login) as last_login
		,CONVERT(DATETIME2(0), tbl_users.last_login) as last_login
		,tbl_users.avatar
		,tbl_prefix_atm.prefix_atm
		,tbl_roles.role
from atm_monitoring..tbl_user_role
	left join atm_monitoring..tbl_users
		on tbl_user_role.user_name = tbl_users.user_name
	left join atm_monitoring..tbl_roles
		on tbl_user_role.user_right = tbl_roles.user_right
	left join atm_monitoring..tbl_prefix_atm
		on tbl_user_role.prefix_atm =  tbl_prefix_atm.prefix_atm
GO


