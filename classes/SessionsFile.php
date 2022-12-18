<?php
//------------------------------------------------------------------------------------
// sessions.php										
// sistem session dengan data disimpan di database MySQL, bukan di filesystem
// oleh : Erick Lazuardi
// 1/26/2005 6:12PM
//------------------------------------------------------------------------------------

/* TABLE DEFINITION */

/* 
CREATE TABLE `sessions` (
    `id_session` varchar(32) NOT NULL default '',
    `moment` bigint(20) NOT NULL default '0',
    `name` varchar(255) NOT NULL default '',
    `data` text NOT NULL) TYPE=MyISAM;
*/

class Sessions
{
	/**
	 * nama tabel yang digunakan untuk menyimpan variabel session
	 */
	var $table = "sessions";
	/**
	 * variabel handle connection ke database mysql
	 */
	var $dbObj;
	/**
	 * life time session
	 */
	var $lifetime;
	

	/**
	 * konstruktor digunakan untuk mengeset var mysql, menghapus session yang expire dan membuat
	 * session baru jika belum ada
	 *
	 * @param int [$lifetime] masa aktif session
	 */
	function sessions(&$dbObj,$lifetime=10800)
	{
		// start session
		session_start();
	}

	/**
	 * function deleteExpireSession untuk menghapus session yang expired
	 *
	 * @param NULL
	 */


	/**
	 * function register untuk mendaftarkan variabel dan isinya ke tabel session
	 *
	 * @param string $name adalah nama variabel yang akan didaftarkan ke session
	 * @param mixed $data adalah data yang akan didaftarkan ke session table
	 */


	function register($name, $data)
	{
        $_SESSION[$name] = $data;

	}
	
	/**
	 * function is_registered untuk mengetahui apakah variabel sudah terdaftar di tabel session belum
	 * 
	 * @param string $name adalah nama variabel yang ingin diperiksa
	 */

	
	function isRegistered($name)
	{
		return bool($_SESSION[$name]);
	}

	/**
	 * function get digunakan untuk mengambil data session dari database berdasarkan namanya
	 *
	 * @param string $name adalah nama variabel yang akan diambil datanya
	 */


	function getSessionValue($name)
	{
		return $_SESSION[$name];

	}

	/**
	 * function unregister untuk menghapus data dan variabel yang telah terdaftar di database
	 *
	 * @param string $name adalah nama variabel yang akan dihapus
	 */


	function unRegisterVariable($name)
	{
		unset($_SESSION[$name]);

	}

	/**
	 * function id untuk mendapatkan id_session
	 *
	 * @param NULL
	 */


	function id()
	{
		return (@session_id());
	}

	/**
	 * function finish untuk menghapus seluruh data dan variabel session dan kemudian mendestroy session
	 *
	 * @param NULL
	 */


	function destroySession()
	{

		//delete session in server
		session_unset();
		session_destroy();
	}

	/**
	 * function numUsers untuk mengetahui berapa banyak user / session yang aktif
	 * 
	 * @param int [$lifetime] adalah waktu user aktif
	 */

	
	function numUsers($lifetime=300)
	{
		$sql = "SELECT id_session FROM ".$this->table." WHERE moment > ".mktime()-$lifetime;
		$this->dbObj->query($sql);
		return $this->dbObj->getNumRows();
	}
	//end class
}
?>