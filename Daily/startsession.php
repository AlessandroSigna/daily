<?php 
function mySessionStart()
				{
					session_start();

					if(!empty($_SESSION['deleted_time']) && $_SESSION['deleted_time']<time()-180)
						 {
						 	session_destroy();
						 	session_start();
						 }
				}
function mySessionRegenerateId()
				{
					if(session_status()!= PHP_SESSION_ACTIVE)
					{
						session_start();
					}
				$newid= session_create_id('code');
				$_SESSION['deleted_time']=time();
				session_commit();
				ini_set('session.use_strict_mode',0);
				session_id($newid);
				session_start();
				}

				ini_set('session.use_strict_mode',1);
				mySessionStart();
				mySessionRegenerateId();
?>