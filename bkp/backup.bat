echo off
mysqldump --user=root --password=root2017 --host=localhost bd_infodp_tienda > C:\wamp\www\infodp\bkp\bd_infodp_tienda_%Date:~6,4%%Date:~3,2%%Date:~0,2%_.sql
exit


rem //se debe habilitar el path donde esta el ejecutable "mysqldump"
rem //para la password si se pone "-p" se solicitara la password, si no, no va nada

rem C:\wamp\bin\mysql\mysql5.6.17\bin