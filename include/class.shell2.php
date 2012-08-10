<?php
/*
SSH - SFTP (class.shell2.php)
v 1.0 2007-08-13
Author : Stieven R. Kalengkian

PHP Manual - CLVIII. Secure Shell2 Functions

Bindings to the libssh2 library which provide access to resources
(shell, remote exec, tunneling, file transfer) on a remote machine
using a secure cryptographic transport.

Installation

Windows binaries may be found at http://snaps.php.net/.
To install, download php_ssh2.dll to the folder specified by your php.ini
file's extension_dir directive. Enable it by adding extension=php_ssh2.dll
to your php.ini and restarting your web server.

+-----------------------------+
| extension_dir=c:/php5/exts/ |
| extension=php_ssh2.dll      |
+-----------------------------+


Linux, BSD, and other *nix variants can be compiled using the following steps:
1. Download and install OpenSSL. If you install OpenSSL via your distribution's
   packaging system be sure to install the development libraries as well.
   This will typically be a package named openssl-dev, openssl_devel, or some
   variation thereof.

2. Download and install libssh2. Typically this means executing the following
   command from the libssh2 source tree. ./configure && make all install.

3. Run the pear installer for PECL/ssh2: pear install ssh2

4. Copy ssh2.so from the directory indicated by the build process to the
   location specified in your php.ini file under extension_dir.

5. Add extension=ssh2.so to your php.ini

6. Restart your web server to reload your php.ini settings.

Development Versions: There are currently no stable versions of PECL/ssh2,
to force installation of the beta version of PECL/ssh2 execute:
pear install ssh2-beta

Compiling PECL/ssh2 without using the PEAR command: Rather than using pear
install ssh2 to automatically download and install PECL/ssh2, you may download
the tarball from PECL. From the root of the unpacked tarball,
run: phpize && ./configure --with-ssh2 && make to generate ssh2.so.
Once built, continue the installation from step 4 above.

Information for installing this PECL extension may be found in the manual
chapter titled Installation of PECL extensions. Additional information
such as new releases, downloads, source files, maintainer information,
and a CHANGELOG, can be located here: http://pecl.php.net/package/ssh2.

Note: You will need version 0.4 or greater of the libssh2 library
(possibly higher, see release notes).

*/


class shell2 {
        var $conn;
        var $error;
        var $stream;

        function login($host,$user,$pass,$port=22) {
                 if ($this->connect($host,$port)) {
                     if ($this->auth($user,$pass)) { return 1; }
                     else { return 0; }
                 } else { return 0; }
        }

        function connect($host,$port=22) {
              if ($this->conn=@ssh2_connect($host, $port)) {
               return 1;
              } else { $this->error="[x] Can not connected to $host $port"; return 0; }
        }

        function auth($u,$p) {
               if (@ssh2_auth_password($this->conn, $u, $p)) {
                       return 1;
               } else { $this->error="Invalid login"; return 0; }
        }

        function send($localFile,$remoteFile,$permision) {
                if (@ssh2_scp_send($this->conn, $localFile, $remoteFile, $permision)) { return 1; }
                else { $this->error="Can not transfer file"; return 0; }
        }

        function get($remoteFile,$localFile) {
                if (@ssh2_scp_recv($this->conn, $remoteFile, $localFile)) { }
        }

        function cmd($cmd) {
                $this->stream=ssh2_exec($this->conn, $cmd);
                stream_set_blocking( $this->stream, true );
        }

        function output() {
               while ($get=fgets($this->stream)) {
                       $line.=$get."<br />";
               }
               return $line;
        }
}

?>